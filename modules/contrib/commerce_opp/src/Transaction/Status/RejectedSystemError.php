<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedSystemError extends Rejected {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_SYSTEM_ERROR;
  }

}