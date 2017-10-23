<?php

/**
 * 
 * Provides a 'MyAccountMenu' block.
 *
 * @Block(
 *   id = "my_account_menu_block",
 *   admin_label = @Translation("My Account Menu Block"),
 *   category = @Translation("My Account Menu Block")
 * )
 */

namespace Drupal\chip4dyno\Plugin\Block;

use Drupal\Core\Block\BlockBase;

class MyAccountMenuBlock extends BlockBase {

  /**
   * Forum Hub page
   */
  public function build() {
    if ($userID = \Drupal::currentUser()->id()) {
      $markupData = '<ul class="my_account_menu">';
      $markupData.= '<li><a href="/user">'.$this->t('My Account').'</a></li>';
      $markupData.= '<li><a href="/user/'.$userID.'/orders">'.$this->t('My Orers').'</a></li>';
      $markupData.= '<li><a href="/user/'.$userID.'/customer">'.$this->t('Address Book').'</a></li>';
      $markupData.= '<li><a href="/buy-credits">'.$this->t('Buy Credits').'</a></li>';
        $markupData.= '</ul>';
      
      $markupData.= '<strong>'.$this->t('MY FILE SERVICES').':</strong><ul class="my_account_menu">';
      $markupData.= '<li><a href="/node/add/turning_files">'.$this->t('File Service').'</a></li>';
      $markupData.='</ul>';

    } else {
      $markupData = '';
    }
    return array(
      '#markup' => $markupData,
      '#cache' => array(
        'contexts' => array(
          'url.path',
        ),
      ),
    );
  }
}
