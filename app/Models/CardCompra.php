<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardCompra extends Model
{
    use HasFactory;

    protected $table = 'cards_compras';


    protected $fillable = [
        'compra_value',
        'compra_time',
        'compra_fatura',
        'card_id',
    ];
    
}
