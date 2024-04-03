<?php

namespace Client;

use ErrorException;
use Service\ServiceInterface;

final readonly class ApiClient
{
    public function __construct(
        public ServiceInterface $service,
        public Methods          $method
    )
    {

    }

    /**
     * @return mixed
     * @throws ErrorException
     */
    public function request(): mixed
    {
        $url = $this->service->getEndpointByMethod($this->method)
            . '?' . http_build_query($this->service->getParametersByMethod($this->method));

        $curl = curl_init($url);

        $headers = [
            'Content-Type: application/json',
        ];

        switch ($this->service->getAuthenticationType()) {
            case AuthenticationTypes::HEADER:
                $headers[] = $this->service->getAuthentication();
                break;
        }

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $headers
        ]);

        $result = json_decode(curl_exec($curl), true);

        if (json_last_error()) {
            throw new ErrorException(json_last_error_msg());
        }
        return $result;
    }
}
