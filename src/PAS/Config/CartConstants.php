<?php

declare(strict_types=1);

namespace PAS\Config;

/**
 * Constants used by the shopping cart workflow.
 *
 * These values represent request keys used when
 * adding items to the cart or updating quantities within the cart.
 */
class CartConstants
{
    public const QUANTITY_KEY = 'quantity';
    public const SUBTOTAL_KEY = 'subtotal';
    public const TOTAL_KEY = 'total';
}
