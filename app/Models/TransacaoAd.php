<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransacaoAd extends Model
{
    use HasFactory;

    // Defina a tabela associada ao modelo
    protected $table = 'transacao_ads';

    // Defina os atributos que podem ser atribuídos em massa
    protected $fillable = [
        'tipo',
        'valor',
        'descricao',
    ];
}
