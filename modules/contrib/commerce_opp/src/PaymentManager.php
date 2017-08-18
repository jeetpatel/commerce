<?php

namespace Drupal\commerce_opp;

use Drupal\commerce_opp\Transaction\Status\Factory;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\commerce_payment\Entity\Payment;
use Drupal\commerce_price\Price;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PaymentManager {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The http client.
   *
   * @var \GuzzleHttp\Client $http_client
   */
  protected $httpClient;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructs a new Payment object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \GuzzleHttp\Client $http_client
   *   A guzzle http client instance.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface
   *   The module handler.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, Client $http_client, ModuleHandlerInterface $module_handler) {
    $this->entityTypeManager = $entity_type_manager;
    $this->httpClient = $http_client;
    $this->moduleHandler = $module_handler;
  }

  public function fetchPaymentStatus(Payment $payment, $resource_path = NULL) {
    if (empty($resource_path)) {
      // If no resource path is provided, construct it using the default path.
      $resource_path = sprintf("/v1/checkouts/%s/payment", $payment->getRemoteId());
    }
    $gateway_entity = $payment->getPaymentGateway();

    /** @var \Drupal\commerce_opp\Plugin\Commerce\PaymentGateway\OpenPaymentPlatform $gateway */
    $gateway = $gateway_entity->getPlugin();
    $target_url = $gateway->getActiveHostUrl() . $resource_path;

    $response = NULL;
    try {
      $response = $this->httpClient->get($target_url);
    }
    catch (RequestException $request_exception) {
      $response = $request_exception->getResponse();
    }
    catch (\Exception $ex) {
      \Drupal::logger('commerce_opp')->error($ex->getMessage());
    }

    if (!empty($response)) {
      $json_response = json_decode($response->getBody(), TRUE);
      return Factory::newInstance($json_response['result']['code'], $json_response['result']['description']);
    }
    return NULL;
  }

  /**
   * Gets the chosen brand from the given order, if set.
   *
   * @param \Drupal\commerce_order\Entity\OrderInterface $order
   *   The order.
   *
   * @return string|null
   *   The brand's name, if exists.
   */
  public function getBrand(OrderInterface $order) {
    return $order->getData('opp_brand', NULL);
  }

  /**
   * Sets an explicit brand on the order. The brand is stored in the order's
   * data property on payment information pane and can be fetched later on
   * building the payment form e.g.
   *
   * @param \Drupal\commerce_order\Entity\OrderInterface $order
   *   The order.
   * @param string $brand
   *   The brand name.
   * @param bool $save
   *   Whether or not to save the order entity.
   */
  public function setBrand(OrderInterface $order, $brand, $save = TRUE) {
    $order->setData('opp_brand', $brand);
    if ($save) {
      $order->save();
    }
  }

  public function getRedirectKey(OrderInterface $order) {
    return $order->getData('opp_redirect_key', NULL);
  }

  public function setRedirectKey(OrderInterface $order, $payment_redirect_key, $save = TRUE) {
    $order->setData('opp_redirect_key', $payment_redirect_key);
    if ($save) {
      $order->save();
    }
  }

  /**
   * Returns the payment amount for the given order, that should be charged.
   * By default, this is exactly the order total, ensuring a decimal precision
   * of exact two digits, as this is required by Open Payment Platform.
   * Further, it gives other modules the possibility to alter this price, e.g.
   * it allows custom modules to provide early payment discounts, that do not
   * change the original order total value.
   *
   * @param \Drupal\commerce_order\Entity\OrderInterface $order
   *   The order entity.
   * @return \Drupal\commerce_price\Price
   *   The calculated payment amount to charge.
   */
  public function getPaymentAmount(OrderInterface $order) {
    /** @var \Drupal\commerce_price\Price $order_total */
    /** @noinspection PhpUndefinedFieldInspection */
    $order_total = $order->total_price->first()->toPrice();
    // Ensure, that amount's decimal precision is exactly 2.
    $rounded_amount = bcadd($order_total->getNumber(), 0, 2);
    $currency_code = $order_total->getCurrencyCode();
    $order_clone = clone $order;
    $this->moduleHandler->alter('commerce_opp_payment_amount', $rounded_amount, $currency_code, $order_clone);
    // Re-ensure, that the amount's decimal precision is exactly 2 after altering.
    $rounded_amount = bcadd($rounded_amount, 0, 2);
    return new Price($rounded_amount, $currency_code);
  }

  /**
   * Deletes unused OPP payment entities. On initializing the COPYandPAY widget,
   * a payment entity gets created. If the user leaves the page without
   * finishing the payment, the newly created entity remains in the database.
   * This function deletes these, by checking its state, as well if the
   * referencing order is already placed. (The payment entities don't have a
   * created timestamp. Pre-authorizations older than 30 minutes are not valid
   * anymore at all.
   *
   * This function is called by the module's cron job.
   *
   * @todo find a solid way to alternatively/additionally filter by timestamp.
   */
  public function cleanupUnusedPaymentEntities() {
    $query = $this->entityTypeManager->getStorage('commerce_payment_gateway')->getQuery();
    $query->condition('plugin', 'open_payment_platform');
    $opp_gateways = $query->execute();
    if (empty($opp_gateways)) {
      return;
    }
    $payment_storage = $this->entityTypeManager->getStorage('commerce_payment');
    $query = $payment_storage->getQuery();
    $query->condition('payment_gateway', $opp_gateways);
    $query->condition('state', 'new');
    $query->condition('order_id.entity.state', 'completed');
    $payments = $query->execute();
    if (empty($payments)) {
      return;
    }
    $payments = $payment_storage->loadMultiple($payments);
    $payment_storage->delete($payments);
  }

}