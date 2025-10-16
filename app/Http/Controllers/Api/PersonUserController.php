<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\PersonUser;
use App\Http\Requests\Api\PersonUserRequest;

class PersonUserController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new PersonUser());

        // Define a classe de validação padrão para store/update
        $this->requestClass = PersonUserRequest::class;
    }
}
