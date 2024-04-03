<?php

namespace Dto;

use Client\Methods;
use Component\Currency;

final readonly class DtoBuilder
{
    public function buildByMethod(Methods $method, array $data): LatestDto
    {
        return match ($method) {
            Methods::LATEST => $this->buildMethodLatest($data)
        };
    }

    public function buildMethodLatest(array $data): LatestDto
    {
        $rates = [];

        if (!empty($data['rates'])) {
            foreach ($data['rates'] as $currencyRate => $value) {
                $currency = Currency::from($currencyRate);
                $rates[$currency->value] = new RatesDto($currency, $value);
            }
        }

        return new LatestDto(
            $data['disclaimer'] ?? '',
            $data['license'] ?? '',
            $data['timestamp'] ?? 0,
            Currency::from($data['base'] ?? ''),
            $rates,
        );
    }
}
