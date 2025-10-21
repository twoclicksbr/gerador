<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_plan';

    protected $fillable = [
        'id_credential',
        'name',
        'price_monthly',
        'price_yearly',
        'active',
    ];

    protected $hidden = [
        'id_credential',
    ];

    public function features()
    {
        return $this->hasMany(PlanFeature::class, 'id_plan');
    }
}
