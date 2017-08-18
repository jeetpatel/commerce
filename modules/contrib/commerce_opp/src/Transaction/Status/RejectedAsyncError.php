<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedAsyncError extends Rejected {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_ASYNC_ERROR;
  }

}