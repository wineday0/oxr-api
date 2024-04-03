<?php

namespace Service;

use Client\AuthenticationTypes;
use Client\Methods;

interface ServiceInterface
{
    public function getEndpointByMethod(Methods $method);

    public function getBasePath();

    public function getAuthenticationType(): AuthenticationTypes;

    public function getAuthentication();

    public function getParametersByMethod(Methods $method): array;
}
