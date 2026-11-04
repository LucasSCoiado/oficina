<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PessoaSeeder::class,
            ClienteSeeder::class,
            FuncionarioSeeder::class,
            OficinaSeeder::class,
            CarroSeeder::class,
            OrdemServicoSeeder::class,
        ]);
    }
}
