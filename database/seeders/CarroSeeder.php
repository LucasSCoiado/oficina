<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carros = [
            [
                'cliente_email' => 'clienteA@example.com',
                'placa' => 'ABC1D23',
                'modelo' => 'Fiat Uno',
                'ano' => 2018,
            ],
            [
                'cliente_email' => 'clienteB@example.com',
                'placa' => 'DEF4G56',
                'modelo' => 'Honda Civic',
                'ano' => 2021,
            ],
            [
                'cliente_email' => 'clienteC@example.com',
                'placa' => 'HIJ7K89',
                'modelo' => 'Volkswagen Gol',
                'ano' => 2016,
            ],
        ];

        foreach ($carros as $carro) {
            $clienteId = DB::table('clientes')
                ->where('email', $carro['cliente_email'])
                ->value('id');

            if ($clienteId === null) {
                throw new \RuntimeException("Cliente não encontrado para o carro {$carro['placa']}.");
            }

            DB::table('carros')->updateOrInsert(
                ['placa' => $carro['placa']],
                [
                    'cliente_id' => $clienteId,
                    'modelo' => $carro['modelo'],
                    'ano' => $carro['ano'],
                ]
            );
        }
    }
}
