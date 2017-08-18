<?php

namespace Drupal\commerce_opp\Controller;

use Drupal\commerce_opp\PaymentManager;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CopyAndPayController extends ControllerBase {

  /**
   * The OPP payment manager.
   *
   * @var \Drupal\commerce_opp\PaymentManager
   */
  protected $paymentManager;

  /**
   * Constructs a new CopyAndPayController.
   *
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user.
   * @param \Drupal\commerce_opp\PaymentManager $payment_manager
   *   The OPP payment manager
   */
  public function __construct(PaymentManager $payment_manager) {
    $this->paymentManager = $payment_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('commerce_opp.payment_manager')
    );
  }

  public function widget(OrderInterface $commerce_order, $payment_redirect_key) {
    return $this->formBuilder()->getForm('Drupal\commerce_opp\Form\CopyAndPayForm', $commerce_order);
  }

  public function access(OrderInterface $commerce_order, $payment_redirect_key) {
    $correct_redirect_key = $this->paymentManager->getRedirectKey($commerce_order);
    $is_allowed = !empty($payment_redirect_key) && $correct_redirect_key == $payment_redirect_key && $commerce_order->getCustomerId() == $this->currentUser()->id();
    // @todo check for order status + if already paid or not...
    return AccessResult::allowedIf($is_allowed);
  }

}