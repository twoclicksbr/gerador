<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_project';

    protected $fillable = [
        'id_credential',
        'name',
        'slug',
        'active',
        'description',
    ];

    public function credential()
    {
        return $this->belongsTo(Credential::class, 'id_credential');
    }

    public function tokens()
    {
        return $this->hasMany(Token::class, 'id_project');
    }
}
