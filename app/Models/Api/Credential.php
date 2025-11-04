<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credential extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_credential';

    protected $fillable = [
        'name',
        'slug',
        'dt_limit_access',
        'active',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan');
    }

    public function token()
    {
        return $this->hasOne(Token::class, 'id_credential');
    }
}
