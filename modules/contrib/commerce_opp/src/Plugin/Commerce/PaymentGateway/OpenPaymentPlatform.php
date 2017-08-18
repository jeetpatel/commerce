<?php

namespace Drupal\commerce_opp\Plugin\Commerce\PaymentGateway;

use Drupal\commerce_opp\Brands;
use Drupal\commerce_payment\Plugin\Commerce\PaymentGateway\PaymentGatewayBase;
use Drupal\Core\Form\FormStateInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Provides the Open Payment Platform gateway class.
 *
 * @CommercePaymentGateway(
 *   id = "open_payment_platform",
 *   label = "Open Payment Platform",
 *   display_label = "Open Payment Platform",
 *   payment_method_types = {"credit_card", "paypal"},
 * )
 */
class OpenPaymentPlatform extends PaymentGatewayBase {

  const DEFAULT_HOST_PROD = 'https://oppwa.com';

  const DEFAULT_HOST_TEST = 'https://test.oppwa.com';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'user_id' => '',
      'password' => '',
      'entity_id' => '',
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['user_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('User ID'),
      '#default_value' => $this->configuration['user_id'],
      '#required' => TRUE,
    ];

    $form['password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
      '#default_value' => $this->configuration['password'],
      '#required' => TRUE,
    ];

    $form['entity_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('The entity for the request'),
      '#description' => $this->t("By default this is the channel's ID. It can be the division, merchant or channel identifier. Division is for requesting registrations only, merchant only in combination with channel dispatching, i.e. channel is the default for sending payment transactions."),
      '#default_value' => $this->configuration['entity_id'],
      '#required' => TRUE,
    ];

    $form['display_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Display label'),
      '#default_value' => !empty($this->configuration['display_label']) ? $this->configuration['display_label'] : 'Open Payment Platform',
      '#required' => TRUE,
    ];

    $form['host'] = [
      '#type' => 'details',
      '#title' => $this->t("Gateway base URLs"),
      '#open' => FALSE,
    ];

    $form['host']['host_prod'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Host URL (prod environment)'),
      '#description' => $this->t('The host URL for the production environment (defaults to %host_url)', ['%host_url' => self::DEFAULT_HOST_PROD]),
      '#default_value' => $this->getProductionHostUrl(),
      '#required' => TRUE,
    ];

    $form['host']['host_test'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Host URL (test environment)'),
      '#description' => $this->t('The host URL for the test environment (defaults to %host_url)', ['%host_url' => self::DEFAULT_HOST_TEST]),
      '#default_value' => $this->getTestHostUrl(),
      '#required' => TRUE,
    ];

    $form['brands'] = [
      '#type' => 'details',
      '#title' => $this->t("Supported brands"),
      '#open' => FALSE,
    ];

    $form['brands']['brands_bank'] = [
      '#type' => 'select',
      '#title' => $this->t("Supported bank account brands"),
      '#multiple' => TRUE,
      '#options' => Brands::getBankAccountBrandLabels(),
      '#default_value' => isset($this->configuration['brands_bank']) ? $this->configuration['brands_bank'] : '',
      '#empty_value' => '',
      '#attributes' => ['size' => 10],
    ];

    $form['brands']['brands_card'] = [
      '#type' => 'select',
      '#title' => $this->t("Supported card account brands"),
      '#multiple' => TRUE,
      '#options' => Brands::getCardAccountBrandLabels(),
      '#default_value' => isset($this->configuration['brands_card']) ? $this->configuration['brands_card'] : '',
      '#empty_value' => '',
      '#attributes' => ['size' => 10],
    ];

    $form['brands']['brands_virtual'] = [
      '#type' => 'select',
      '#title' => $this->t("Supported virtual account brands"),
      '#multiple' => TRUE,
      '#options' => Brands::getVirtualAccountBrandLabels(),
      '#default_value' => isset($this->configuration['brands_virtual']) ? $this->configuration['brands_virtual'] : '',
      '#empty_value' => '',
      '#attributes' => ['size' => 10],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);

    if (!$form_state->getErrors()) {
      $values = $form_state->getValue($form['#parents']);
      $this->configuration['user_id'] = $values['user_id'];
      $this->configuration['password'] = $values['password'];
      $this->configuration['entity_id'] = $values['entity_id'];
      $this->configuration['display_label'] = $values['display_label'];
      $this->configuration['brands_bank'] = $values['brands']['brands_bank'];
      $this->configuration['brands_card'] = $values['brands']['brands_card'];
      $this->configuration['brands_virtual'] = $values['brands']['brands_virtual'];
      $this->configuration['host_prod'] = $values['host']['host_prod'];
      $this->configuration['host_test'] = $values['host']['host_test'];
    }
  }

  public function prepareCheckout(array $params = []) {
    $checkout_id = NULL;
    $base_url = $this->getActiveHostUrl();
    $url = $base_url . '/v1/checkouts';
    /** @var \GuzzleHttp\Client $client */
    $client = \Drupal::httpClient();
    $params += [
      'authentication.userId' => $this->configuration['user_id'],
      'authentication.password' => $this->configuration['password'],
      'authentication.entityId' => $this->configuration['entity_id'],
    ];
    try {
      $response = $client->post($url, ['form_params' => $params]);
      $json_response = json_decode($response->getBody(), TRUE);
      if (!empty($json_response['id'])) {
        $checkout_id = $json_response['id'];
      }
    }
    catch (RequestException $request_exception) {
//      $response = $request_exception->getResponse();
//      $json_response = json_decode($response->getBody(), TRUE);
      // @todo better feedback!
      \Drupal::logger('commerce_opp')->error($request_exception->getMessage());
    }
    catch (\Exception $ex) {
      \Drupal::logger('commerce_opp')->error($ex->getMessage());
    }
    return $checkout_id;
  }

  /**
   * Returns a list of supported bank account brands.
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   A list of supported bank account brands.
   */
  public function getActiveBankAccountBrands() {
    $brands = $this->getActiveBankAccountBrandIds();
    array_walk($brands, function (&$value, $key) {
      $value = Brands::getBrand($key);
    });
    return $brands;
  }

  /**
   * Returns a list of supported card account brands.
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   A list of supported card account brands.
   */
  public function getActiveCardAccountBrands() {
    $brands = $this->getActiveCardAccountBrandIds();
    array_walk($brands, function (&$value, $key) {
      $value = Brands::getBrand($key);
    });
    return $brands;
  }

  /**
   * Returns a list of supported virtual account brands.
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   A list of supported virtual account brands.
   */
  public function getActiveVirtualAccountBrands() {
    $brands = $this->getActiveVirtualAccountBrandIds();
    array_walk($brands, function (&$value, $key) {
      $value = Brands::getBrand($key);
    });
    return $brands;
  }

  /**
   * Returns a list of supported bank account brand IDs.
   *
   * @return string[]
   *   A list of supported bank account brand IDs.
   */
  public function getActiveBankAccountBrandIds() {
    return $this->configuration['brands_bank'];
  }

  /**
   * Returns a list of supported card account brand IDs.
   *
   * @return string[]
   *   A list of supported card account brand IDs.
   */
  public function getActiveCardAccountBrandIds() {
    return $this->configuration['brands_card'];
  }

  /**
   * Returns a list of supported virtual account brand IDs.
   *
   * @return string[]
   *   A list of supported virtual account brand IDs.
   */
  public function getActiveVirtualAccountBrandIds() {
    return $this->configuration['brands_virtual'];
  }

  public function getActiveHostUrl() {
    return $this->getMode() == 'test' ? $this->getTestHostUrl() : $this->getProductionHostUrl();
  }

  public function getProductionHostUrl() {
    return !empty($this->configuration['host_prod']) ? $this->configuration['host_prod'] : self::DEFAULT_HOST_PROD;
  }

  public function getTestHostUrl() {
    return !empty($this->configuration['host_test']) ? $this->configuration['host_test'] : self::DEFAULT_HOST_TEST;
  }

}
