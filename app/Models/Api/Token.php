<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_token';

    protected $fillable = [
        'id_credential',
        'environment',
        'token',
        'ip_address',
        'device_info',
        'active',
    ];

    protected $hidden = [
        'id_credential',
    ];
}
