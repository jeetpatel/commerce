<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedRiskValidation extends RejectedRisk {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_RISK_VALIDATION;
  }

}