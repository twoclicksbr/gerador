<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_person';

    protected $fillable = [
        'id_credential',
        'name',
        'whatsapp',
        'cpf_cnpj',
        'gender',
        'birthdate',
        'active',
    ];

    protected $hidden = [
        'id_credential',
    ];

    public function credential()
    {
        return $this->belongsTo(Credential::class, 'id_credential');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id_person')->where('main', 1);
    }

    public function user()
    {
        return $this->hasOne(PersonUser::class, 'id_person');
    }

    public function personPlan()
    {
        return $this->hasOne(PersonPlan::class, 'id_person');
    }
}
