<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardEmpresa extends Model
{
    use HasFactory;

    protected $table = 'cards_empresa';

    protected $fillable = [
        'empresa_razao',
        'empresa_cnpj',
        'empresa_status',
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'card_empresa_id');
    }
}
