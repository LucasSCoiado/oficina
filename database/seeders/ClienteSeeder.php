<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [
            ['cpf' => '111.111.111-11', 'email' => 'clienteA@example.com', 'telefone' => '11999990001'],
            ['cpf' => '222.222.222-22', 'email' => 'clienteB@example.com', 'telefone' => '11999990002'],
            ['cpf' => '333.333.333-33', 'email' => 'clienteC@example.com', 'telefone' => '11999990003'],
        ];

        foreach ($clientes as $cliente) {
            $pessoaId = DB::table('pessoas')
                ->where('telefone', $cliente['telefone'])
                ->value('id');

            if ($pessoaId === null) {
                throw new \RuntimeException("Pessoa não encontrada para o cliente {$cliente['email']}.");
            }

            DB::table('clientes')->updateOrInsert(
                ['email' => $cliente['email']],
                [
                    'cpf' => $cliente['cpf'],
                    'pessoa_id' => $pessoaId,
                ]
            );
        }
    }
}
