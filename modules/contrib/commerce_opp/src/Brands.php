<?php

namespace Drupal\commerce_opp;

/**
 * Provides logic for listing available brands, optionally filtered by type.
 * @todo It would make sense to open a Drupal independent library at Github.
 */
class Brands {

  /**
   * The instantiated brands.
   *
   * @var \Drupal\commerce_opp\Brand[]
   */
  public static $brands = [];

  /**
   * Gets the brand with the given ID.
   *
   * @param string $id
   *   The brand ID. For example: 'VISA'.
   *
   * @return \Drupal\commerce_opp\Brand
   *   The brand.
   */
  public static function getBrand($id) {
    $brands = self::getBrands();
    if (!isset($brands[$id])) {
      throw new \InvalidArgumentException(sprintf('Invalid brand "%s"', $id));
    }
    return $brands[$id];
  }

  /**
   * Gets all available brands.
   * Source: https://docs.payon.com/tutorials/integration-guide (2016-07-13)
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   The available brands.
   */
  public static function getBrands() {
    $definitions = [
      // (Credit) card account brands.
      'WORLD' => [
        'id' => 'WORLD',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'WORLD',//@todo correct label
        'sync' => TRUE,
      ],
      'VPAY' => [
        'id' => 'VPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'VPAY',//@todo correct label
        'sync' => TRUE,
      ],
      'VISAELECTRON' => [
        'id' => 'VISAELECTRON',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'VISAELECTRON',//@todo correct label
        'sync' => TRUE,
      ],
      'VISADEBIT' => [
        'id' => 'VISADEBIT',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'VISADEBIT',//@todo correct label
        'sync' => TRUE,
      ],
      'VISA' => [
        'id' => 'VISA',
        'commerce_id' => 'visa',
        'type' => Brand::TYPE_CARD,
        'label' => 'Visa',
        'sync' => TRUE,
      ],
      'TARJETASHOPPING' => [
        'id' => 'TARJETASHOPPING',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'TARJETASHOPPING',//@todo correct label
        'sync' => TRUE,
      ],
      'SERVIRED' => [
        'id' => 'SERVIRED',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'SERVIRED',//@todo correct label
        'sync' => TRUE,
      ],
      'POSTEPAY' => [
        'id' => 'POSTEPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'POSTEPAY',//@todo correct label
        'sync' => TRUE,
      ],
      'NATIVA' => [
        'id' => 'NATIVA',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'NATIVA',//@todo correct label
        'sync' => TRUE,
      ],
      'NARANJA' => [
        'id' => 'NARANJA',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'NARANJA',//@todo correct label
        'sync' => TRUE,
      ],
      'MERCADOLIVRE' => [
        'id' => 'MERCADOLIVRE',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'MERCADOLIVRE',//@todo correct label
        'sync' => TRUE,
      ],
      'MAXIMUM' => [
        'id' => 'MAXIMUM',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'MAXIMUM',//@todo correct label
        'sync' => TRUE,
      ],
      'MASTERDEBIT' => [
        'id' => 'MASTERDEBIT',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'MASTERDEBIT',//@todo correct label
        'sync' => TRUE,
      ],
      'MASTER' => [
        'id' => 'MASTER',
        'commerce_id' => 'mastercard',
        'type' => Brand::TYPE_CARD,
        'label' => 'MasterCard',
        'sync' => TRUE,
      ],
      'MAESTRO' => [
        'id' => 'MAESTRO',
        'commerce_id' => 'maestro',
        'type' => Brand::TYPE_CARD,
        'label' => 'Maestro',
        'sync' => TRUE,
      ],
      'JCB' => [
        'id' => 'JCB',
        'commerce_id' => 'jcb',
        'type' => Brand::TYPE_CARD,
        'label' => 'JCB',
        'sync' => TRUE,
      ],
      'HIPERCARD' => [
        'id' => 'HIPERCARD',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'HIPERCARD',//@todo correct label
        'sync' => TRUE,
      ],
      'ELO' => [
        'id' => 'ELO',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'ELO',//@todo correct label
        'sync' => TRUE,
      ],
      'DISCOVER' => [
        'id' => 'DISCOVER',
        'commerce_id' => 'discover',
        'type' => Brand::TYPE_CARD,
        'label' => 'Discover Card',
        'sync' => TRUE,
      ],
      'DINERS' => [
        'id' => 'DINERS',
        'commerce_id' => 'dinersclub',
        'type' => Brand::TYPE_CARD,
        'label' => 'Diners Club',
        'sync' => TRUE,
      ],
      'DANKORT' => [
        'id' => 'DANKORT',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'DANKORT',//@todo correct label
        'sync' => TRUE,
      ],
      'CENCOSUD' => [
        'id' => 'CENCOSUD',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'CENCOSUD',//@todo correct label
        'sync' => TRUE,
      ],
      'CARTEBLEUE' => [
        'id' => 'CARTEBLEUE',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'CARTEBLEUE',//@todo correct label
        'sync' => TRUE,
      ],
      'CARTEBANCAIRE' => [
        'id' => 'CARTEBANCAIRE',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'CARTEBANCAIRE',//@todo correct label
        'sync' => TRUE,
      ],
      'CARDFINANS' => [
        'id' => 'CARDFINANS',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'CARDFINANS',//@todo correct label
        'sync' => TRUE,
      ],
      'CABAL' => [
        'id' => 'CABAL',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'CABAL',//@todo correct label
        'sync' => TRUE,
      ],
      'BONUS' => [
        'id' => 'BONUS',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'BONUS',//@todo correct label
        'sync' => TRUE,
      ],
      'BCMC' => [
        'id' => 'BCMC',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'BCMC',//@todo correct label
        'sync' => FALSE,
      ],
      'AXESS' => [
        'id' => 'AXESS',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'AXESS',//@todo correct label
        'sync' => TRUE,
      ],
      'ASYACARD' => [
        'id' => 'ASYACARD',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'ASYACARD',//@todo correct label
        'sync' => TRUE,
      ],
      'ARGENCARD' => [
        'id' => 'ARGENCARD',
        'commerce_id' => '',
        'type' => Brand::TYPE_CARD,
        'label' => 'ARGENCARD',//@todo correct label
        'sync' => TRUE,
      ],
      'AMEX' => [
        'id' => 'AMEX',
        'commerce_id' => 'amex',
        'type' => Brand::TYPE_CARD,
        'label' => 'American Express',
        'sync' => TRUE,
      ],
      // Virtual account brands.
      'YANDEX' => [
        'id' => 'YANDEX',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'YANDEX',//@todo correct label
        'sync' => FALSE,
      ],
      'TRUSTLY' => [
        'id' => 'TRUSTLY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'TRUSTLY',//@todo correct label
        'sync' => FALSE,
      ],
      'TENPAY' => [
        'id' => 'TENPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'TENPAY',//@todo correct label
        'sync' => FALSE,
      ],
      'SHETAB' => [
        'id' => 'SHETAB',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'SHETAB',//@todo correct label
        'sync' => FALSE,
      ],
      'QIWI' => [
        'id' => 'QIWI',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'QIWI',//@todo correct label
        'sync' => FALSE,
      ],
      'PRZELEWY' => [
        'id' => 'PRZELEWY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PRZELEWY',//@todo correct label
        'sync' => FALSE,
      ],
      'PF_KARTE_DIRECT' => [
        'id' => 'PF_KARTE_DIRECT',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PF_KARTE_DIRECT',//@todo correct label
        'sync' => FALSE,
      ],
      'PAYTRAIL' => [
        'id' => 'PAYTRAIL',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PAYTRAIL',//@todo correct label
        'sync' => FALSE,
      ],
      'PAYSAFECARD' => [
        'id' => 'PAYSAFECARD',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'paysafecard',
        'sync' => FALSE,
      ],
      'PAYPAL' => [
        'id' => 'PAYPAL',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PayPal',
        'sync' => FALSE,
      ],
      'PAYOLUTION_INVOICE' => [
        'id' => 'PAYOLUTION_INVOICE',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PAYOLUTION_INVOICE',//@todo correct label
        'sync' => FALSE,
      ],
      'PAYOLUTION_INS' => [
        'id' => 'PAYOLUTION_INS',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PAYOLUTION_INS',//@todo correct label
        'sync' => FALSE,
      ],
      'PAYOLUTION_ELV' => [
        'id' => 'PAYOLUTION_ELV',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PAYOLUTION_ELV',//@todo correct label
        'sync' => FALSE,
      ],
      'PAYDIREKT' => [
        'id' => 'PAYDIREKT',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PAYDIREKT',//@todo correct label
        'sync' => FALSE,
      ],
      'PAYBOX' => [
        'id' => 'PAYBOX',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'PAYBOX',//@todo correct label
        'sync' => FALSE,
      ],
      'ONECARD' => [
        'id' => 'ONECARD',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'ONECARD',//@todo correct label
        'sync' => FALSE,
      ],
      'MONEYSAFE' => [
        'id' => 'MONEYSAFE',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'MONEYSAFE',//@todo correct label
        'sync' => FALSE,
      ],
      'MONEYBOOKERS' => [
        'id' => 'MONEYBOOKERS',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'MONEYBOOKERS',//@todo correct label
        'sync' => FALSE,
      ],
      'MASTERPASS' => [
        'id' => 'MASTERPASS',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'MASTERPASS',//@todo correct label
        'sync' => FALSE,
      ],
      'KLARNA_INVOICE' => [
        'id' => 'KLARNA_INVOICE',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'KLARNA_INVOICE',//@todo correct label
        'sync' => TRUE,
      ],
      'KLARNA_INSTALLMENTS' => [
        'id' => 'KLARNA_INSTALLMENTS',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'KLARNA_INSTALLMENTS',//@todo correct label
        'sync' => FALSE,
      ],
      'IPARA' => [
        'id' => 'IPARA',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'IPARA',//@todo correct label
        'sync' => FALSE,
      ],
      'DAOPAY' => [
        'id' => 'DAOPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'DAOPAY',//@todo correct label
        'sync' => FALSE,
      ],
      'CHINAUNIONPAY' => [
        'id' => 'CHINAUNIONPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'CHINAUNIONPAY',//@todo correct label
        'sync' => FALSE,
      ],
      'CASHU' => [
        'id' => 'CASHU',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'CASHU',//@todo correct label
        'sync' => FALSE,
      ],
      'ASTROPAY_STREAMLINE_OT' => [
        'id' => 'ASTROPAY_STREAMLINE_OT',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'ASTROPAY_STREAMLINE_OT',//@todo correct label
        'sync' => FALSE,
      ],
      'ASTROPAY_STREAMLINE_CASH' => [
        'id' => 'ASTROPAY_STREAMLINE_CASH',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'ASTROPAY_STREAMLINE_CASH',//@todo correct label
        'sync' => FALSE,
      ],
      'ALIPAY' => [
        'id' => 'ALIPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'ALIPAY',//@todo correct label
        'sync' => FALSE,
      ],
      'AFTERPAY' => [
        'id' => 'AFTERPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_VIRTUAL,
        'label' => 'AFTERPAY',//@todo correct label
        'sync' => TRUE,
      ],
      // Bank account brands.
      'TRUSTPAY_VA' => [
        'id' => 'TRUSTPAY_VA',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'TRUSTPAY_VA',//@todo correct label
        'sync' => FALSE,
      ],
      'SOFORTUEBERWEISUNG' => [
        'id' => 'SOFORTUEBERWEISUNG',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'SOFORT Überweisung',
        'sync' => FALSE,
      ],
      'PREPAYMENT' => [
        'id' => 'PREPAYMENT',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'PREPAYMENT',//@todo correct label
        'sync' => FALSE,
      ],
      'POLI' => [
        'id' => 'POLI',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'POLI',//@todo correct label
        'sync' => FALSE,
      ],
      'OXXO' => [
        'id' => 'OXXO',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'OXXO',//@todo correct label
        'sync' => FALSE,
      ],
      'INTERAC_ONLINE' => [
        'id' => 'INTERAC_ONLINE',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'INTERAC_ONLINE',//@todo correct label
        'sync' => FALSE,
      ],
      'IDEAL' => [
        'id' => 'IDEAL',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'iDEAL',
        'sync' => FALSE,
      ],
      'GIROPAY' => [
        'id' => 'GIROPAY',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'GIROPAY',//@todo correct label
        'sync' => FALSE,
      ],
      'EPS' => [
        'id' => 'EPS',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'eps',
        'sync' => FALSE,
      ],
      'ENTERCASH' => [
        'id' => 'ENTERCASH',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'ENTERCASH',//@todo correct label
        'sync' => FALSE,
      ],
      'DIRECTDEBIT_SEPA' => [
        'id' => 'DIRECTDEBIT_SEPA',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'DIRECTDEBIT_SEPA',//@todo correct label
        'sync' => TRUE,
      ],
      'BOLETO' => [
        'id' => 'BOLETO',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'BOLETO',//@todo correct label
        'sync' => FALSE,
      ],
      'BITCOIN' => [
        'id' => 'BITCOIN',
        'commerce_id' => '',
        'type' => Brand::TYPE_BANK,
        'label' => 'BITCOIN',//@todo correct label
        'sync' => TRUE,
      ],
    ];

    foreach ($definitions as $id => $definition) {
      self::$brands[$id] = new Brand($definition);
    }
    return self::$brands;
  }

  /**
   * Gets the labels of all available brands.
   *
   * @return array
   *   The labels, keyed by ID.
   */
  public static function getBrandLabels() {
    $brands = self::getBrands();
    $brand_labels = array_map(function ($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getLabel();
    }, $brands);
    return $brand_labels;
  }

  /**
   * Gets all available card account brands.
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   The available card account brands.
   */
  public static function getCardAccountBrands() {
    $brands = self::getBrands();
    $filtered_brands = array_filter($brands, function($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getType() == Brand::TYPE_CARD;
    });
    return $filtered_brands;
  }

  /**
   * Gets the labels of all available card account brands.
   *
   * @return array
   *   The labels, keyed by ID.
   */
  public static function getCardAccountBrandLabels() {
    $brands = self::getCardAccountBrands();
    $brand_labels = array_map(function ($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getLabel();
    }, $brands);
    return $brand_labels;
  }

  /**
   * Gets all available bank account brands.
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   The available bank account brands.
   */
  public static function getBankAccountBrands() {
    $brands = self::getBrands();
    $filtered_brands = array_filter($brands, function($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getType() == Brand::TYPE_BANK;
    });
    return $filtered_brands;
  }

  /**
   * Gets the labels of all available bank account brands.
   *
   * @return array
   *   The labels, keyed by ID.
   */
  public static function getBankAccountBrandLabels() {
    $brands = self::getBankAccountBrands();
    $brand_labels = array_map(function ($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getLabel();
    }, $brands);
    return $brand_labels;
  }

  /**
   * Gets all available virtual account brands.
   *
   * @return \Drupal\commerce_opp\Brand[]
   *   The available virtual account brands.
   */
  public static function getVirtualAccountBrands() {
    $brands = self::getBrands();
    $filtered_brands = array_filter($brands, function($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getType() == Brand::TYPE_VIRTUAL;
    });
    return $filtered_brands;
  }

  /**
   * Gets the labels of all available virtual account brands.
   *
   * @return array
   *   The labels, keyed by ID.
   */
  public static function getVirtualAccountBrandLabels() {
    $brands = self::getVirtualAccountBrands();
    $brand_labels = array_map(function ($brand) {
      /** @var \Drupal\commerce_opp\Brand $brand */
      return $brand->getLabel();
    }, $brands);
    return $brand_labels;
  }

}