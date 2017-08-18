<?php

namespace Drupal\commerce_opp\Transaction\Status;

abstract class AbstractStatus {

  /**
   * The result code.
   *
   * @var $code string
   */
  protected $code;

  /**
   * The status description.
   *
   * @var $description string
   */
  protected $description;

  /**
   * Constructs a new Status object.
   *
   * @param string $code
   *   The result code.
   * @param string $description
   *   The status description.
   */
  public function __construct($code, $description) {
    $this->code = $code;
    $this->description = $description;
  }

  /**
   * Gets the result code.
   *
   * @return string
   *   The result code.
   */
  public function getCode() {
    return $this->code;
  }

  /**
   * Gets the status description.
   *
   * @return string
   *   The status description.
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Gets the type of this status - one of the TYPE_* constants of the Constants
   * class. As the class of the given instance already implies the status type,
   * this can be seen as redundant information for convenience.
   *
   * @return string
   *   The status type (whether if the transaction was successful, failed, etc).
   */
  public abstract function getType();

}