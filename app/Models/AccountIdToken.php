<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountIdToken extends Model
{
    use HasFactory;

    protected $table = 'account_id_tokens';

    protected $fillable = [
        'name',
        'account_id',
        'probability',
    ];
}
