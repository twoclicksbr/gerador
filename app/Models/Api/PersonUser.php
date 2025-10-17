<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_person_user';

    protected $fillable = [
        'id_credential',
        'id_person',
        'email',
        'password',
        'remember_token',
        'active',
    ];

    protected $hidden = [
        'id_credential',
        'password',
        'remember_token',
    ];

    public function credential()
    {
        return $this->belongsTo(Credential::class, 'id_credential');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }
}
