<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdemServico extends Model
{
    protected $table = 'ordem_servicos';

    protected $fillable = [
        'carro_id',
        'funcionario_id',
        'oficina_id',
        'numero',
        'data_abertura',
        'status',
        'valor_total',
        'descricao',
    ];

    public function carro(): BelongsTo
    {
        return $this->belongsTo(Carro::class);
    }
}
