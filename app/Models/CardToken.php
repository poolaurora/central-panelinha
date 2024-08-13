<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardToken extends Model
{
    use HasFactory;

    protected $table = 'card_token';

    protected $fillable = [
        'id',
        'token_id',
        'card_id',
    ];

    protected $casts = [
        'id' => 'string',
        'token_id' => 'string'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
