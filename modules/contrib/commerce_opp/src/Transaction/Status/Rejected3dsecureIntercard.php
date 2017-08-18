<?php

namespace Drupal\commerce_opp\Transaction\Status;

class Rejected3dsecureIntercard extends Rejected {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_REJECTED_3DSECURE_INTERCARD;
  }

}