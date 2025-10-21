<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Address;
use App\Http\Requests\Api\AddressRequest;

class AddressController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new Address());

        // Define a classe de validação padrão para store/update
        $this->requestClass = AddressRequest::class;
    }
}
