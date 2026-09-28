<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carro_id')
                ->constrained('carros')
                ->onDelete('cascade');

            $table->foreignId('funcionario_id')
                ->constrained('funcionarios')
                ->onDelete('cascade');

            $table->foreignId('oficina_id')
                ->constrained('oficinas')
                ->onDelete('cascade');

            $table->integer('numero');
            $table->date('data_abertura');
            $table->string('status');
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_servicos');
    }
};
