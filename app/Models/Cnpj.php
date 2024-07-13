<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\CheckCnpjStatus;

class Cnpj extends Model
{
    use HasFactory;
    
    protected $table = 'cnpjs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj',
        'razao_social',
        'status',
    ];
}
