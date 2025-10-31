<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class EmailConfirmation extends Model
{
    protected $table = 'email_confirmation';

    protected $fillable = [
        'email',
        'token',
        'confirmed',
        'confirmed_at',
    ];
}
