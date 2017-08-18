<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedValidationRisk extends RejectedValidation {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_VALIDATION_RISK;
  }

}