<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_type_address';

    protected $fillable = [
        'id_credential',
        'name',
        'active',
    ];

    protected $hidden = [
        'id_credential',
    ];
}
