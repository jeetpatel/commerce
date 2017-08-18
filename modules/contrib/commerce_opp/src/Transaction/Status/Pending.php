<?php

namespace Drupal\commerce_opp\Transaction\Status;

class Pending extends SuccessOrPending {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_PENDING;
  }

}