<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonPlan extends Model
{
    use SoftDeletes;

    protected $table = 'tc_person_plan';

    protected $fillable = [
        'id_credential',
        'id_person',
        'id_plan',
        'payment_cycle',
        'dt_start',
        'dt_end',
        'active',
    ];

    protected $casts = [
        'dt_start' => 'datetime',
        'dt_end'   => 'datetime',
        'active'   => 'boolean',
    ];

    // 🔹 Relacionamentos
    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan');
    }
}
