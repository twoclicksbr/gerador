<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Token;
use App\Http\Requests\Api\TokenRequest;

class TokenController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new Token());

        // Define a classe de validação padrão para store/update
        $this->requestClass = TokenRequest::class;
    }
}
