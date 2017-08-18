<?php

namespace Drupal\commerce_opp\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowInterface;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneInterface;
use Drupal\commerce_opp\PaymentManager;
use Drupal\Component\Utility\Crypt;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Site\Settings;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Provides the payment type selection pane.
 *
 * @CommerceCheckoutPane(
 *   id = "commerce_opp_copy_and_pay",
 *   label = @Translation("COPYandPAY"),
 *   default_step = "offsite_payment",
 *   wrapper_element = "fieldset",
 * )
 */
class CopyAndPay extends CheckoutPaneBase implements CheckoutPaneInterface, ContainerFactoryPluginInterface {

  /**
   * The OPP payment manager.
   *
   * @var \Drupal\commerce_opp\PaymentManager
   */
  protected $paymentManager;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * The HTTP kernel.
   *
   * @var \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  protected $httpKernel;

  /**
   * The event dispatcher
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * Constructs a new Payment object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowInterface $checkout_flow
   *   The parent checkout flow.
   * @param \Drupal\commerce_opp\PaymentManager $payment_manager
   *   The OPP payment manager
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack
   * @param \Symfony\Component\HttpKernel\HttpKernelInterface $http_kernel
   *   The HTTP kernel
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   *   The event dispatcher
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CheckoutFlowInterface $checkout_flow, PaymentManager $payment_manager, RequestStack $request_stack, HttpKernelInterface $http_kernel, EventDispatcherInterface $event_dispatcher) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $checkout_flow);
    $this->paymentManager = $payment_manager;
    $this->requestStack = $request_stack;
    $this->httpKernel = $http_kernel;
    $this->eventDispatcher = $event_dispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, CheckoutFlowInterface $checkout_flow = NULL) {
    /** @noinspection PhpParamsInspection */
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $checkout_flow,
      $container->get('commerce_opp.payment_manager'),
      $container->get('request_stack'),
      $container->get('http_kernel'),
      $container->get('event_dispatcher')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {
    $payment_redirect_key = Crypt::hmacBase64(sprintf('%s:%s', $this->order->id(), REQUEST_TIME), Settings::getHashSalt());
    $this->paymentManager->setRedirectKey($this->order, $payment_redirect_key, TRUE);
    $payment_url = Url::fromRoute('commerce_opp.copy_and_pay', [
      'commerce_order' => $this->order->id(),
      'payment_redirect_key' => $payment_redirect_key,
    ], ['absolute' => TRUE]);
    $this->sendResponse(new LocalRedirectResponse($payment_url->toString()));
  }

  /**
   * {@inheritdoc}
   */
  public function isVisible() {
    /** @noinspection PhpUndefinedFieldInspection */
    // @todo debug, why the order can be empty, if payment fails!?!
    if ($this->order && $this->order->hasField('payment_gateway') && !$this->order->payment_gateway->isEmpty()) {
      /** @var \Drupal\commerce_payment\Entity\PaymentGatewayInterface $payment_gateway */
      /** @noinspection PhpUndefinedFieldInspection */
      $payment_gateway = $this->order->payment_gateway->entity;
      if ($payment_gateway && $payment_gateway->getPluginId() == 'open_payment_platform') {
        return TRUE;
      }
    }
    return FALSE;
  }

  private function sendResponse(Response $response) {
    $request = $this->requestStack->getCurrentRequest();
    $event = new FilterResponseEvent($this->httpKernel, $request, HttpKernelInterface::MASTER_REQUEST, $response);

    $this->eventDispatcher->dispatch(KernelEvents::RESPONSE, $event);
    // Prepare and send the response.
    $event->getResponse()
      ->prepare($request)
      ->send();
    $this->httpKernel->terminate($request, $response);
    exit;
  }

}
