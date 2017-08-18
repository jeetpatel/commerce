<?php

namespace Drupal\commerce_opp\Transaction\Status;

class RejectedCommunicationError extends Rejected {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_COMMUNICATION_ERROR;
  }

}