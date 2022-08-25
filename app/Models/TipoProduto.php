<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    use HasFactory;

    protected $table = 'tipos_produto';
    public $timestamps = false;
    protected  $primaryKey = 'id';

    protected $fillable = [
        'codigo',
        'descricao'
    ];
}
