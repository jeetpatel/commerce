<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedRiskAddress extends RejectedRisk {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_RISK_ADDRESS;
  }

}