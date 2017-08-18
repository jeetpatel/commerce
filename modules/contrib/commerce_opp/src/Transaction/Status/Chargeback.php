<?php

namespace Drupal\commerce_opp\Transaction\Status;

class Chargeback extends AbstractStatus {

  /**
   * @inheritDoc
   */
  public function getType() {
    return Constants::TYPE_CHARGEBACK;
  }

}