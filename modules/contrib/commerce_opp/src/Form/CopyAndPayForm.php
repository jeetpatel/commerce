<?php

namespace Drupal\commerce_opp\Form;

use Drupal\commerce_opp\PaymentManager;
use Drupal\commerce_opp\PaymentTypes;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\commerce_payment\Entity\Payment;
use Drupal\commerce_price\Price;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the payment form containing the COPYandPAY widget.
 */
class CopyAndPayForm extends FormBase {

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * The OPP payment manager.
   *
   * @var \Drupal\commerce_opp\PaymentManager
   */
  protected $paymentManager;

  /**
   * Constructs a new CopyAndPayForm object.
   *
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\commerce_opp\PaymentManager $payment_manager
   *   The OPP payment manager
   */
  public function __construct(LanguageManagerInterface $language_manager, PaymentManager $payment_manager) {
    $this->languageManager = $language_manager;
    $this->paymentManager = $payment_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /** @noinspection PhpParamsInspection */
    return new static(
      $container->get('language_manager'),
      $container->get('commerce_opp.payment_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'commerce_opp_copyandpay_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, OrderInterface $order = NULL) {
    if (empty($order)) {
      throw new \InvalidArgumentException('The order entity passed to CopyAndPayForm must not be empty!');
    }

    /** @var \Drupal\commerce_opp\Plugin\Commerce\PaymentGateway\OpenPaymentPlatform $opp_gateway */
    /** @noinspection PhpUndefinedFieldInspection */
    $opp_gateway = $order->payment_gateway->entity->getPlugin();
    $brand = $this->paymentManager->getBrand($order);
    $payment_amount = $this->paymentManager->getPaymentAmount($order);

    $request_params = [
      'currency' => $payment_amount->getCurrencyCode(),
      'amount' => $payment_amount->getNumber(),
      'paymentType' => PaymentTypes::DEBIT,
      'descriptor' => $this->t('Order number @order_number', ['@order_number' => $order->getOrderNumber()]),
    ];
    /*if ($brand) {
      $request_params['paymentBrand'] = $brand;
    }*/
    $checkout_id = $opp_gateway->prepareCheckout($request_params);

    if (empty($checkout_id)) {
      $form['error'] = ['#markup' => 'An unknown error occurred when connecting to the payment gateway. Please contact the site administrator and/or choose a different payment method.'];
      return $form;
    }

    $script_url = sprintf("%s/v1/paymentWidgets.js?checkoutId=%s", $opp_gateway->getActiveHostUrl(), $checkout_id);
    $js_settings = [
      'opp_script_url' => $script_url,
      'checkout_id' => $checkout_id,
      'cards' => $brand,
      'langcode' => $this->languageManager->getCurrentLanguage()->getId(),
    ];
    $form['#attached']['drupalSettings']['commerce_opp'] = $js_settings;
    $form['#attached']['library'][] = 'commerce_opp/init';

    $form['#checkout_id'] = $checkout_id;
    $form['#order_id'] = $order->id();
    $form['#payment_amount'] = $payment_amount;
    $form['cards'] = ['#markup' => $brand];
    $form['#attributes']['class'][] = 'paymentWidgets';
    $form['#action'] = Url::fromRoute('commerce_opp.callback', [], ['absolute' => TRUE])->toString();

    // Create a payment entity, which will be processed later on receiving the callback from the gateway.
    /** @noinspection PhpUndefinedFieldInspection */
    $payment = Payment::create([
      'payment_gateway' => $order->payment_gateway->entity->id(),
      'order_id' => $order->id(),
      'state' => 'new',
      'remote_id' => $checkout_id,
      'type' => 'payment_default',
    ]);
    $payment->setAmount($payment_amount);
    $payment->save();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Can be left empty, as we don't have an action button at all.
    // The embedded payment widget has it's own "pay" button integrated instead.
  }

}
