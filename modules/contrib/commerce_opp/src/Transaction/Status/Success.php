<?php

namespace Drupal\commerce_opp\Transaction\Status;

class Success extends SuccessOrPending {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_SUCCESS;
  }

}