<?php

namespace Dto;

use Component\Currency;

final readonly class RatesDto
{
    public function __construct(
        public Currency $currency,
        public float    $value
    )
    {

    }
}
