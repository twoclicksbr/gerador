<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\PlanFeature;
use App\Http\Requests\Api\PlanFeatureRequest;

class PlanFeatureController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new PlanFeature());

        // Define a classe de validação padrão para store/update
        $this->requestClass = PlanFeatureRequest::class;
    }
}
