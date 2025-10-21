<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_address';

    protected $fillable = [
        'id_credential',
        'id_person',
        'id_type_address',
        'main',
        'cep',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
    ];

    protected $casts = [
        'main' => 'boolean',
    ];

    // 🔹 Relacionamentos
    public function credential()
    {
        return $this->belongsTo(Credential::class, 'id_credential');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }

    public function typeAddress()
    {
        return $this->belongsTo(TypeAddress::class, 'id_type_address');
    }
}
