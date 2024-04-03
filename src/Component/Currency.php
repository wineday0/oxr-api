<?php

namespace Component;

/**
 * Currency ISO codes
 */
enum Currency: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case RUB = 'RUB';
    case GBP = 'GBP';
    case JPY = 'JPY';
    case INR = 'INR';
    case CNY = 'CNY';
    case CAD = 'CAD';
    case AUD = 'AUD';
    case CHF = 'CHF';

    // Add more currency codes as needed
}
