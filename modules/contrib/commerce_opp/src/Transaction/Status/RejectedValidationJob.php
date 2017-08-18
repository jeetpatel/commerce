<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedValidationJob extends RejectedValidation {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_VALIDATION_JOB;
  }

}