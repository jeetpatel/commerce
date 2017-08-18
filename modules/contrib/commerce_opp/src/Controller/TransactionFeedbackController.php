<?php

namespace Drupal\commerce_opp\Controller;

use Drupal\commerce_checkout\CheckoutOrderManagerInterface;
use Drupal\commerce_checkout\Event\CheckoutCompleteEvent;
use Drupal\commerce_checkout\Event\CheckoutEvents;
use Drupal\commerce_opp\PaymentManager;
use Drupal\commerce_opp\Transaction\Status\Rejected;
use Drupal\commerce_opp\Transaction\Status\SuccessOrPending;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransactionFeedbackController extends ControllerBase {

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * The checkout order manager.
   *
   * @var \Drupal\commerce_checkout\CheckoutOrderManagerInterface
   */
  protected $checkoutOrderManager;

  /**
   * The OPP payment manager.
   *
   * @var \Drupal\commerce_opp\PaymentManager
   */
  protected $paymentManager;

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * Constructs a new TransactionFeedbackController.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack
   * @param \Drupal\commerce_checkout\CheckoutOrderManagerInterface $checkout_order_manager
   *   The checkout order manager
   * @param \Drupal\commerce_opp\PaymentManager $payment_manager
   *   The OPP payment manager
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   *   The event dispatcher.
   */
  public function __construct(RequestStack $request_stack, CheckoutOrderManagerInterface $checkout_order_manager, PaymentManager $payment_manager, EventDispatcherInterface $event_dispatcher) {
    $this->requestStack = $request_stack;
    $this->checkoutOrderManager = $checkout_order_manager;
    $this->paymentManager = $payment_manager;
    $this->eventDispatcher = $event_dispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('request_stack'),
      $container->get('commerce_checkout.checkout_order_manager'),
      $container->get('commerce_opp.payment_manager'),
      $container->get('event_dispatcher')
    );
  }

  public function callback() {
    $query_string = $this->requestStack->getCurrentRequest()->query;
    $id = $query_string->get('id');
    $resource_path = $query_string->get('resourcePath');
    if (empty($id) || empty($resource_path)) {
      // Invalid request.
      throw new NotFoundHttpException();
    }

    $payments = $this->entityTypeManager()->getStorage('commerce_payment')->loadByProperties(['remote_id' => $id]);
    if (empty($payments)) {
      // Invalid request - unknown payment ID.
      $this->getLogger('commerce_opp')->error('Invalid transaction feedback request - payment ID unknown: %payment_id', ['%payment_id' => $id]);
      throw new BadRequestHttpException();
    }
    /** @var \Drupal\commerce_payment\Entity\Payment $payment */
    $payment = reset($payments);
    if ($payment->getState()->value != 'new') {
      // Invalid request - unknown payment ID.
      $this->getLogger('commerce_opp')->error('Invalid transaction feedback request - payment ID %payment_id already processed, having state: %state', ['%payment_id' => $id, '%state' => $payment->getState()->valu]);
      throw new BadRequestHttpException();
    }

    $order = $payment->getOrder();
    $status = $this->paymentManager->fetchPaymentStatus($payment, $resource_path);

    if (!empty($status)) {
      if ($status instanceof SuccessOrPending) {
        $authorize_transition = $payment->getState()->getWorkflow()->getTransition('authorize');
        $payment->getState()->applyTransition($authorize_transition);
        $payment->setAuthorizedTime(REQUEST_TIME);
        $capture_transition = $payment->getState()->getWorkflow()->getTransition('capture');
        $payment->getState()->applyTransition($capture_transition);
        $payment->setCapturedTime(REQUEST_TIME);
        $payment->save();
        // Reset the time based redirect key.
        $this->paymentManager->setRedirectKey($order, '', TRUE);

        /*
         * @todo the next lines are repeating the code from
         * \Drupal\commerce_checkout\Plugin\Commerce\CheckoutFlow\CheckoutFlowBase
         * That's rather bad - we need a better way to return to the checkout flow!
         */
        $order->checkout_step = 'complete';
        $order->cart = FALSE;
        // Place the order.
        $transition = $order->getState()->getWorkflow()->getTransition('place');
        $order->getState()->applyTransition($transition);
        $order->save();

        return $this->redirect('commerce_checkout.form', [
          'commerce_order' =>$order->id(),
          'step' => 'complete',
        ]);
      }
      elseif ($status instanceof Rejected) {
        // Redirect back to order information step (having payment pane).
        $order->checkout_step = $this->getPaymentStepId($order);
        $order->save();
        drupal_set_message($this->t('Payment failed! Please try another payment method instead.'));
        return $this->redirect('commerce_checkout.form', [
          'commerce_order' =>$order->id(),
        ]);
      }
    }

    // @todo It is theoretically not possible, that we didn't enter one of the both if statements above. However, we will fail the payment, if we get to this point somehow.
    $this->getLogger('commerce_opp')->error('The transaction feedback was neither success nor failed for payment %payment_id', ['%payment_id' => $id]);
    $order->checkout_step = $this->getPaymentStepId($order);
    $order->save();
    drupal_set_message($this->t('Payment failed! Please try another payment method instead.'));
    return $this->redirect('commerce_checkout.form', [
      'commerce_order' =>$order->id(),
    ]);
  }

  private function getPaymentStepId(OrderInterface $order) {
    $checkout_flow = $this->checkoutOrderManager->getCheckoutFlow($order);
    $steps = $checkout_flow->getPlugin()->getVisibleSteps();
    return isset($steps['order_information']) ? 'order_information' : 'review';
  }

}