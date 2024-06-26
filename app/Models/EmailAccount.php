<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'imap_host',
        'imap_port',
        'imap_encryption',
        'imap_validate_cert',
    ];

    protected $hidden = [
        'password',
    ];
}
