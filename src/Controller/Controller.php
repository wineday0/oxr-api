<?php

namespace Controller;

use Client\ApiClient;
use Client\Methods;
use Dto\DtoBuilder;
use Dto\LatestDto;
use ErrorException;
use Service\OpenExchangeRateService;

final readonly class Controller
{
    /**
     * @return LatestDto
     * @throws ErrorException
     */
    public function getOXRLatest(): LatestDto
    {
        $client = new ApiClient(
            new OpenExchangeRateService(),
            Methods::LATEST
        );

        return (new DtoBuilder())->buildByMethod(Methods::LATEST, $client->request());
    }
}
