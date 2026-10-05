<?php

namespace Tests\Feature;

use App\Models\Funcionario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FuncionarioLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_served_by_fortify(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Acesso de funcionários')
            ->assertSee('name="email"', false);
    }

    public function test_employee_can_log_in_and_open_the_home_page(): void
    {
        $funcionario = $this->createFuncionario();

        $this->post('/login', [
            'email' => $funcionario->email,
            'password' => 'senha-segura-123',
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs($funcionario);
        $this->get('/')->assertOk();
    }

    public function test_employee_cannot_log_in_with_an_invalid_password(): void
    {
        $funcionario = $this->createFuncionario();

        $this->from('/login')
            ->post('/login', [
                'email' => $funcionario->email,
                'password' => 'senha-incorreta',
            ])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    private function createFuncionario(): Funcionario
    {
        $pessoaId = DB::table('pessoas')->insertGetId([
            'nome' => 'Funcionário Teste',
            'telefone' => '11988887777',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Funcionario::create([
            'pessoa_id' => $pessoaId,
            'cpf' => '12345678901',
            'email' => 'funcionario@example.com',
            'cargo' => 'Atendente',
            'password' => 'senha-segura-123',
        ]);
    }
}
