<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedRiskBlacklist extends RejectedRisk {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_RISK_BLACKLIST;
  }

}