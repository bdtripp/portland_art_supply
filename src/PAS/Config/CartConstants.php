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
    public const string QUANTITY_FIELD = 'Quantity';
    public const string SUBTOTAL_FIELD = 'Subtotal';
    public const string TOTAL_FIELD = 'Total';
}
