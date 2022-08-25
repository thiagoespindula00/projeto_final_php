<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    use HasFactory;
    protected $table = 'operacoes';
    public $timestamps = false;
    protected  $primaryKey = 'id';

    protected $fillable = [
        'codigo',
        'descricao'
    ];
}
