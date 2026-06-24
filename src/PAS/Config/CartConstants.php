<?php

/**
 * Constants used by the shopping cart workflow.
 *
 * These values represent request keys used when
 * adding items to the cart or updating quantities within the cart.
 */

declare(strict_types=1);

namespace PAS\Config;

class CartConstants
{
    public const QUANTITY_KEY = 'Quantity';
    public const SUBTOTAL_KEY = 'Subtotal';
    public const TOTAL_KEY = 'Total';
}
