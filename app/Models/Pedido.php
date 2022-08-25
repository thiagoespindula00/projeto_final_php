<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    public $timestamps = false;
    protected  $primaryKey = 'numero';

    protected $fillable = [
        'nome_cliente',
        'mesa',
        'forma_pagamento_id'
    ];

    public function forma_pagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedidos_produtos')->withPivot('quantidade', 'preco');
    }
}
