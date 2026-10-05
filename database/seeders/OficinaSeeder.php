<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oficinas = [
            ['cnpj' => '12.345.678/0001-90', 'nome' => 'Oficina Central'],
            ['cnpj' => '98.765.432/0001-10', 'nome' => 'Auto Center Norte'],
        ];

        foreach ($oficinas as $oficina) {
            DB::table('oficinas')->updateOrInsert(
                ['cnpj' => $oficina['cnpj']],
                ['nome' => $oficina['nome']]
            );
        }
    }
}
