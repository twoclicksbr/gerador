<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Credential;
use App\Http\Requests\Api\CredentialRequest;

class CredentialController extends UniversalApiController
{
    public function __construct()
    {
        parent::__construct(new Credential());

        // Define a classe de validação padrão para store/update
        $this->requestClass = CredentialRequest::class;
    }
}
