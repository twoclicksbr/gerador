<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\PersonPlan;
use App\Http\Requests\Api\PersonPlanRequest;

class PersonPlanController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new PersonPlan());

        // Define a classe de validação padrão para store/update
        $this->requestClass = PersonPlanRequest::class;
    }
}
