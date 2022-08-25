<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;
    protected $table = 'formas_pagamento';
    public $timestamps = false;
    protected  $primaryKey = 'id';

    protected $fillable = [
        'codigo',
        'descricao'
    ];
}
