<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas = [
            ['nome' => 'Cliente A', 'telefone' => '11999990001'],
            ['nome' => 'Cliente B', 'telefone' => '11999990002'],
            ['nome' => 'Cliente C', 'telefone' => '11999990003'],
            ['nome' => 'Funcionário A', 'telefone' => '11999990004'],
            ['nome' => 'Funcionário B', 'telefone' => '11999990005'],
        ];

        foreach ($pessoas as $pessoa) {
            DB::table('pessoas')->updateOrInsert(
                ['telefone' => $pessoa['telefone']],
                ['nome' => $pessoa['nome']]
            );
        }
    }
}
