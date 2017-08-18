<?php

namespace Drupal\commerce_opp\Transaction\Status;

class SuccessNeedingReview extends SuccessOrPending {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_SUCCESS_NEEDING_REVIEW;
  }

}