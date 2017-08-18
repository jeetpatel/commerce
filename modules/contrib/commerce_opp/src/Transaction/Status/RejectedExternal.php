<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedExternal extends Rejected {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_EXTERNAL;
  }

}