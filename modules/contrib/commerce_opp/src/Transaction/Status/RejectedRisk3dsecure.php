<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedRisk3dsecure extends RejectedRisk {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_RISK_3DSECURE;
  }

}