<?php

/**
 * @file
 * Hooks provided by the commerce_opp module.
 */

/**
 * Allows to alter the payment amount and currency, that will be charged by
 * Open Payment Platform for the given order. Subtract early payment discounts,
 * that do not change the original order total value, etc.
 *
 * @param float $amount
 *   The payment amount.
 * @param string $currency_code
 *   The currency code.
 * @param \Drupal\commerce_order\Entity\OrderInterface $order
 *   The order entity.
 */
function hook_commerce_opp_payment_amount_alter(&$amount, &$currency_code, \Drupal\commerce_order\Entity\OrderInterface &$order) {
  // Subtract early payment discounts, that do not change the original order total value, etc.
}
