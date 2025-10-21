<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Plan;
use App\Http\Requests\Api\PlanRequest;

class PlanController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new Plan());

        // Define a classe de validação padrão para store/update
        $this->requestClass = PlanRequest::class;
    }
}
