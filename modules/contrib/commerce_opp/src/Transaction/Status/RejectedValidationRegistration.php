<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedValidationRegistration extends RejectedValidation {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_VALIDATION_REGISTRATION;
  }

}