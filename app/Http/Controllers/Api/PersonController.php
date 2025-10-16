<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Person;
use App\Http\Requests\Api\PersonRequest;

class PersonController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new Person());

        // Define a classe de validação padrão para store/update
        $this->requestClass = PersonRequest::class;
    }
}
