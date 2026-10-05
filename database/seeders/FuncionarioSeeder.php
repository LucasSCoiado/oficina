<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $funcionarios = [
            [
                'cpf' => '44444444444',
                'email' => 'funcionarioA@example.com',
                'cargo' => 'Atendente',
                'telefone' => '11999990004',
            ],
            [
                'cpf' => '55555555555',
                'email' => 'funcionarioB@example.com',
                'cargo' => 'Gerente',
                'telefone' => '11999990005',
            ],
        ];

        foreach ($funcionarios as $funcionario) {
            $pessoaId = DB::table('pessoas')
                ->where('telefone', $funcionario['telefone'])
                ->value('id');

            if ($pessoaId === null) {
                throw new \RuntimeException("Pessoa não encontrada para o funcionário {$funcionario['email']}.");
            }

            DB::table('funcionarios')->updateOrInsert(
                ['email' => $funcionario['email']],
                [
                    'cpf' => $funcionario['cpf'],
                    'cargo' => $funcionario['cargo'],
                    'pessoa_id' => $pessoaId,
                ]
            );
        }
    }
}
