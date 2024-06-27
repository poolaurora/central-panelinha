<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PixSecret extends Model
{
    use HasFactory;

    protected $table = 'pix_secrets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 
        'appId', 
        'app_secret', 
        'refresh_token',
    ];
}
