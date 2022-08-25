<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    public $timestamps = false;
    protected  $primaryKey = 'id';

    protected $fillable = [
        'codigo',
        'descricao',
        'preco',
        'tipo_produto_id'
    ];

    public function tipo_produto()
    {
        return $this->belongsTo(TipoProduto::class);
    }

    public function operacoes()
    {
        return $this->belongsToMany(Operacao::class, 'produtos_operacoes');
    }
}
