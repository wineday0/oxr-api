<?php

namespace Dto;

use Component\Currency;

final readonly class LatestDto
{
    public function __construct(
        public string   $disclaimer,
        public string   $license,
        public int      $timestamp,
        public Currency $base,
        public array    $rates
    )
    {

    }
}
