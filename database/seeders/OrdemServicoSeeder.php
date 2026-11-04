<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrdemServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordens = [
            [
                'numero' => 1001,
                'carro_placa' => 'ABC1D23',
                'funcionario_email' => 'funcionarioA@example.com',
                'oficina_cnpj' => '12.345.678/0001-90',
                'data_abertura' => '2026-10-01',
                'status' => 'Concluída',
                'valor_total' => 350.00,
                'descricoes' => [
                    'Troca de óleo e filtros',
                    'Revisão preventiva do motor',
                    'Substituição das pastilhas de freio',
                ],
            ],
            [
                'numero' => 1002,
                'carro_placa' => 'DEF4G56',
                'funcionario_email' => 'funcionarioB@example.com',
                'oficina_cnpj' => '98.765.432/0001-10',
                'data_abertura' => '2026-10-02',
                'status' => 'Em andamento',
                'valor_total' => 780.50,
                'descricoes' => [
                    'Diagnóstico do sistema elétrico',
                    'Reparo da suspensão dianteira',
                    'Revisão do sistema de arrefecimento',
                ],
            ],
            [
                'numero' => 1003,
                'carro_placa' => 'HIJ7K89',
                'funcionario_email' => 'funcionarioA@example.com',
                'oficina_cnpj' => '12.345.678/0001-90',
                'data_abertura' => '2026-10-03',
                'status' => 'Aberta',
                'valor_total' => 0.00,
                'descricoes' => [
                    'Avaliação geral do veículo',
                    'Verificação de ruído no motor',
                    'Inspeção do sistema de freios',
                ],
            ],
        ];

        foreach ($ordens as $ordem) {
            $carroId = DB::table('carros')
                ->where('placa', $ordem['carro_placa'])
                ->value('id');
            $funcionarioId = DB::table('funcionarios')
                ->where('email', $ordem['funcionario_email'])
                ->value('id');
            $oficinaId = DB::table('oficinas')
                ->where('cnpj', $ordem['oficina_cnpj'])
                ->value('id');

            if ($carroId === null || $funcionarioId === null || $oficinaId === null) {
                throw new \RuntimeException("Não foi possível encontrar todas as relações da ordem {$ordem['numero']}.");
            }

            DB::table('ordem_servicos')->updateOrInsert(
                ['numero' => $ordem['numero']],
                [
                    'carro_id' => $carroId,
                    'funcionario_id' => $funcionarioId,
                    'oficina_id' => $oficinaId,
                    'data_abertura' => $ordem['data_abertura'],
                    'status' => $ordem['status'],
                    'valor_total' => $ordem['valor_total'],
                    'descricao' => Arr::random($ordem['descricoes']),
                ]
            );
        }
    }
}
