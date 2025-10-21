<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\TypeAddress;
use App\Http\Requests\Api\TypeAddressRequest;

class TypeAddressController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new TypeAddress());

        // Define a classe de validação padrão para store/update
        $this->requestClass = TypeAddressRequest::class;
    }
}
