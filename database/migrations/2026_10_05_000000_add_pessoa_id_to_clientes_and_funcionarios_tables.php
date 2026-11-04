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
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('pessoa_id')
                ->nullable()
                ->constrained('pessoas')
                ->cascadeOnDelete();
        });

        Schema::table('funcionarios', function (Blueprint $table) {
            $table->foreignId('pessoa_id')
                ->nullable()
                ->constrained('pessoas')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pessoa_id');
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pessoa_id');
        });
    }
};
