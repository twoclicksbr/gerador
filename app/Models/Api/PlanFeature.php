<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_plan_feature';

    protected $fillable = [
        'id_credential',
        'id_plan',
        'name',
        'description',
        'value',
        'active',
    ];

    protected $hidden = [
        'id_credential',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan');
    }
}
