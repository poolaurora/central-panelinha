<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'card_number',
        'card_holderName',
        'card_YY',
        'card_MM',
        'card_cvv',
        'card_empresa_id',
        'card_status',
    ];

    public function purchases()
    {
        return $this->hasMany(CardCompra::class, 'card_id');
    }

    public function empresa()
    {
        return $this->belongsTo(CardEmpresa::class, 'card_empresa_id');
    }

    public function token()
    {
        return $this->hasOne(CardToken::class, 'card_id');
    }
}
