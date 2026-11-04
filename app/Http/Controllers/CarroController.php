<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\OrdemServico;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class CarroController extends Controller
{
    public function index()
    {
        $carros = Carro::all();
        return view('carros.index', compact('carros'));
    }

    public function carro($id)
    {
        $carro = Carro::with(['cliente.pessoa', 'ordensServico'])->findOrFail($id);

        return view('carros.carro', compact('carro'));
    }

    public function create()
    {
        $clientes = Cliente::with('pessoa')->orderBy('id')->get();
        $funcionarios = Funcionario::orderBy('email')->get();
        $oficinas = DB::table('oficinas')->orderBy('nome')->get();

        return view('carros.create', compact('clientes', 'funcionarios', 'oficinas'));
    }

    public function store(Request $request)
    {
        $placa = $request->input('placa');
        if (is_string($placa)) {
            $request->merge(['placa' => strtoupper($placa)]);
        }

        $validated = $request->validate([
            'marca' => ['nullable', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'ano' => ['required', 'integer', 'digits:4'],
            'placa' => ['required', 'string', 'max:7', 'unique:carros,placa'],
            'descricao' => ['nullable', 'string'],
            'cliente_existente' => ['required', 'boolean'],
            'cliente_id' => ['required_if:cliente_existente,1', 'nullable', 'integer', 'exists:clientes,id'],
            'nome' => ['required_unless:cliente_existente,1', 'nullable', 'string', 'max:255'],
            'telefone' => ['required_unless:cliente_existente,1', 'nullable', 'string', 'max:255'],
            'cpf' => ['required_unless:cliente_existente,1', 'nullable', 'string', 'max:255'],
            'email' => ['required_unless:cliente_existente,1', 'nullable', 'email', 'max:255'],
            'funcionario_id' => ['required', 'integer', 'exists:funcionarios,id'],
            'oficina_id' => ['required', 'integer', 'exists:oficinas,id'],
            'ordem_descricao' => ['required', 'string', 'max:1000'],
            'valor_total' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated): void {
            if ($validated['cliente_existente']) {
                $clienteId = $validated['cliente_id'];
            } else {
                $pessoa = Pessoa::create([
                    'nome' => $validated['nome'],
                    'telefone' => $validated['telefone'],
                ]);

                $cliente = Cliente::create([
                    'pessoa_id' => $pessoa->id,
                    'cpf' => $validated['cpf'],
                    'email' => $validated['email'],
                ]);
                $clienteId = $cliente->id;
            }

            $carro = Carro::create([
                'cliente_id' => $clienteId,
                'marca' => $validated['marca'] ?? null,
                'modelo' => $validated['modelo'],
                'ano' => $validated['ano'],
                'placa' => $validated['placa'],
                'descricao' => $validated['descricao'] ?? null,
            ]);

            $carro->ordensServico()->create([
                'funcionario_id' => $validated['funcionario_id'],
                'oficina_id' => $validated['oficina_id'],
                'numero' => (int) (DB::table('ordem_servicos')->max('numero') ?? 1000) + 1,
                'data_abertura' => now()->toDateString(),
                'status' => 'Aberto',
                'valor_total' => $validated['valor_total'],
                'descricao' => $validated['ordem_descricao'],
            ]);
        });

        return redirect()->route('carros.trabalho')->with('success', 'Carro cadastrado e serviço enviado para a fila de trabalho.');
    }

    public function edit($id)
    {
        $carro = Carro::with('cliente.pessoa')->findOrFail($id);
        $clientes = Cliente::with('pessoa')->orderBy('id')->get();

        return view('carros.edit', compact('carro', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $carro = Carro::findOrFail($id);

        $placa = $request->input('placa');
        if (is_string($placa)) {
            $request->merge(['placa' => strtoupper($placa)]);
        }

        $validated = $request->validate([
            'marca' => ['nullable', 'string', 'max:255'],
            'modelo' => ['required', 'string', 'max:255'],
            'ano' => ['required', 'integer', 'digits:4'],
            'placa' => ['required', 'string', 'max:7', 'unique:carros,placa,' . $carro->id],
            'descricao' => ['nullable', 'string'],
            'cliente_existente' => ['required', 'boolean'],
            'cliente_id' => ['required_if:cliente_existente,1', 'nullable', 'integer', 'exists:clientes,id'],
            'nome' => ['required_unless:cliente_existente,1', 'nullable', 'string', 'max:255'],
            'telefone' => ['required_unless:cliente_existente,1', 'nullable', 'string', 'max:255'],
            'cpf' => ['required_unless:cliente_existente,1', 'nullable', 'string', 'max:255'],
            'email' => ['required_unless:cliente_existente,1', 'nullable', 'email', 'max:255'],
        ]);

        DB::transaction(function () use ($carro, $validated): void {
            if ($validated['cliente_existente']) {
                $clienteId = $validated['cliente_id'];
            } else {
                $pessoa = $carro->cliente?->pessoa;

                if ($pessoa) {
                    $pessoa->update([
                        'nome' => $validated['nome'],
                        'telefone' => $validated['telefone'],
                    ]);
                } else {
                    $pessoa = Pessoa::create([
                        'nome' => $validated['nome'],
                        'telefone' => $validated['telefone'],
                    ]);
                }

                $cliente = $carro->cliente;

                if ($cliente) {
                    $cliente->update([
                        'pessoa_id' => $pessoa->id,
                        'cpf' => $validated['cpf'],
                        'email' => $validated['email'],
                    ]);
                    $clienteId = $cliente->id;
                } else {
                    $cliente = Cliente::create([
                        'pessoa_id' => $pessoa->id,
                        'cpf' => $validated['cpf'],
                        'email' => $validated['email'],
                    ]);
                    $clienteId = $cliente->id;
                }
            }

            $carro->update([
                'cliente_id' => $clienteId,
                'marca' => $validated['marca'] ?? null,
                'modelo' => $validated['modelo'],
                'ano' => $validated['ano'],
                'placa' => $validated['placa'],
                'descricao' => $validated['descricao'] ?? null,
            ]);
        });

        return redirect()->route('carros.index')->with('success', 'Carro atualizado com sucesso');
    }

    public function destroy($id)
    {
        $carro = Carro::findOrFail($id);
        $carro->delete();

        return redirect()->route('carros.index')->with('success', 'Carro removido com sucesso');
    }

    // página de trabalhos

    public function index_trabalho()
    {
        $ordens = OrdemServico::with('carro.cliente.pessoa')
            ->whereRaw('LOWER(status) IN (?, ?, ?)', ['aberto', 'aberta', 'em andamento'])
            ->orderBy('data_abertura')
            ->get();
        $ordensAguardando = $ordens->filter(fn(OrdemServico $ordem) => in_array(strtolower($ordem->status), ['aberto', 'aberta'], true));
        $ordensEmAndamento = $ordens->filter(fn(OrdemServico $ordem) => strtolower($ordem->status) === 'em andamento');

        return view('carros.trabalho.index', compact('ordensAguardando', 'ordensEmAndamento'));
    }

    public function iniciarServico($id)
    {
        $ordem = OrdemServico::whereKey($id)
            ->whereRaw('LOWER(status) IN (?, ?)', ['aberto', 'aberta'])
            ->firstOrFail();

        $ordem->update(['status' => 'Em andamento']);

        return redirect()->route('carros.trabalho')->with('success', "Ordem #{$ordem->numero} iniciada.");
    }

    public function finalizarServico($id)
    {
        $ordem = OrdemServico::whereKey($id)
            ->whereRaw('LOWER(status) = ?', ['em andamento'])
            ->firstOrFail();

        $ordem->update(['status' => 'Finalizado']);

        return redirect()->route('carros.carro', ['id' => $ordem->carro_id])
            ->with('success', "Ordem #{$ordem->numero} finalizada.");
    }

    public function addServico()
    {
        $carros = Carro::with('cliente.pessoa')->orderBy('placa')->get();
        $funcionarios = Funcionario::orderBy('email')->get();
        $oficinas = DB::table('oficinas')->orderBy('nome')->get();

        return view('carros.trabalho.create_servico', compact('carros', 'funcionarios', 'oficinas'));
    }

    public function storeServico(Request $request)
    {
        $validated = $request->validate([
            'carro_id' => ['required', 'integer', 'exists:carros,id'],
            'funcionario_id' => ['required', 'integer', 'exists:funcionarios,id'],
            'oficina_id' => ['required', 'integer', 'exists:oficinas,id'],
            'descricao' => ['required', 'string', 'max:1000'],
            'valor_total' => ['required', 'numeric', 'min:0'],
        ]);

        $carro = Carro::findOrFail($validated['carro_id']);
        $numero = (int) (DB::table('ordem_servicos')->max('numero') ?? 1000) + 1;

        $carro->ordensServico()->create([
            'funcionario_id' => $validated['funcionario_id'],
            'oficina_id' => $validated['oficina_id'],
            'numero' => $numero,
            'data_abertura' => now()->toDateString(),
            'status' => 'Aberto',
            'valor_total' => $validated['valor_total'],
            'descricao' => $validated['descricao'],
        ]);

        return redirect()->route('carros.trabalho')->with('success', 'Serviço adicionado com sucesso');
    }

    public function index_finalizado()
    {
        $ordensFinalizadas = OrdemServico::with('carro.cliente.pessoa')
            ->whereRaw('LOWER(status) = ?', ['finalizado'])
            ->orderBy('data_abertura')
            ->get();

        return view('carros.finalizado.index', compact('ordensFinalizadas'));
    }
}
