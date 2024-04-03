<?php

namespace Service;

use Client\AuthenticationTypes;
use Client\Methods;
use Component\Currency;

/**
 * @link https://docs.openexchangerates.org/reference/api-introduction
 */
final readonly class OpenExchangeRateService implements ServiceInterface
{
    public const string BASE_PATH = 'https://openexchangerates.org/api/';

    /**
     * @link https://docs.openexchangerates.org/reference/latest-json
     */
    public const string ENDPOINT_METHOD_LATEST = 'latest.json';

    /**
     * @link https://docs.openexchangerates.org/reference/set-base-currency
     */
    public const string DEFAULT_CURRENCY = 'USD';

    /**
     * @param Methods $method
     * @return string
     */
    public function getEndpointByMethod(Methods $method): string
    {
        $method = match ($method) {
            Methods::LATEST => self::ENDPOINT_METHOD_LATEST
        };

        return "{$this->getBasePath()}/$method";
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return self::BASE_PATH;
    }

    /**
     * @link https://docs.openexchangerates.org/reference/authentication
     * @return string
     */
    public function getAuthentication(): string
    {
        return 'Authorization: Token ' . getenv('APIKEY');
    }

    /**
     * @param Methods $method
     * @return array
     */
    public function getParametersByMethod(Methods $method): array
    {
        return match ($method) {
            Methods::LATEST => $this->getParametersMethodLatest()
        };
    }

    /**
     * @link https://docs.openexchangerates.org/reference/authentication
     * @return AuthenticationTypes
     */
    public function getAuthenticationType(): AuthenticationTypes
    {
        return AuthenticationTypes::HEADER;
    }

    /**
     * @return array
     */
    public function getParametersMethodLatest(): array
    {
        return [
            'base' => $this->getParameterBase(),
            'symbols' => $this->getParameterSymbols(),
            'prettyprint' => $this->getParameterPrettyprint(),
            'show_alternative' => $this->getParameterShowAlternative()
        ];
    }

    /**
     * Change base currency (3-letter code, default: USD)
     * @return string
     */
    public function getParameterBase(): string
    {
        return self::DEFAULT_CURRENCY;
    }

    /**
     * Limit results to specific currencies (comma-separated list of 3-letter codes)
     * @link https://docs.openexchangerates.org/reference/get-specific-currencies
     *
     * @return string
     */
    public function getParameterSymbols(): string
    {
        return implode(',', [Currency::EUR->value, Currency::EUR->value, Currency::CNY->value]);
    }

    /**
     * Set to false to reduce response size (removes whitespace)
     * @link https://docs.openexchangerates.org/reference/prettyprint
     * @return bool
     */
    public function getParameterPrettyprint(): bool
    {
        return false;
    }

    /**
     * Extend returned values with alternative, black market and digital currency rates
     * @link https://docs.openexchangerates.org/reference/alternative-currencies
     * @return bool
     */
    public function getParameterShowAlternative(): bool
    {
        return false;
    }
}
