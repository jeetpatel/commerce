<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedRiskExternal extends RejectedRisk {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_RISK_EXTERNAL;
  }

}