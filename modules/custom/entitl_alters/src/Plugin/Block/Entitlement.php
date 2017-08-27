<?php

/**
 * @file
 * Contains \Drupal\ttn_entitl_alters\Plugin\Block\Entitlement.
 */

namespace Drupal\ttn_entitl_alters\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'entitlement link' block.
 *
 * @Block(
 *   id = "entitlement_block",
 *   admin_label = @Translation("Entitlement"),
 *   category = @Translation("Custom entitlement block")
 * )
 */
class Entitlement extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    global $base_url;

    $entitconfig = \Drupal::config('config.ttn_entitlement_date');
    $startdate = strtotime($entitconfig->get('entitle.startdate'));
    $enddate = strtotime($entitconfig->get('entitle.enddate'));
    /* Load structure form nodes */
    $currentuseruid = \Drupal::currentUser()->id();
    $currentuserrole = \Drupal::currentUser()->getRoles();
    $data = array();
    $node = \Drupal::entityQuery('node')->condition('type', 'restructure_form')
        ->condition('field_employee_reference', $currentuseruid)
        ->execute();

    if ($node) {
      foreach ($node as $key => $value) {

        $nodeid = $value;
      }
    }
    else {
       return array(
          '#type' => 'markup',
          '#markup' => "",
          '#cache' => array(
            'max-age' => 0
          ),
        );
    }


    $external_link = "";
    $currentdate = strtotime(date("Y-m-d"));
    
   if(in_array("hr_team",$currentuserrole) && in_array("authorised_user",$currentuserrole) && $nodeid!=null){
    $url1 = Url::fromUri($base_url.'/node/'.$nodeid.'/edit');
    $url2 = Url::fromUri($base_url.'/node/add/restructure_form');
    $external_link1 = \Drupal::l(t('Reimbursement Restructuring'), $url1,array('attributes' => array('class' => 'is-active')));
    // $external_link2 = \Drupal::l(t('Add Entitlement'), $url2);
     $external_link = $external_link1;
       return array(
           '#type' => 'markup',
           '#markup' => $external_link,
           '#cache' => array(
           'max-age' => 0
        ),
         );
       }
       
    elseif (in_array("administrator", $currentuserrole) && in_array("authorised_user", $currentuserrole) && $nodeid != null) {

      $url1 = Url::fromUri($base_url . '/node/' . $nodeid . '/edit');
      $url2 = Url::fromUri($base_url . '/node/add/restructure_form');

      $external_link1 = \Drupal::l(t('Reimbursement Restructuring'), $url1);
      // $external_link2 = \Drupal::l(t('Add Entitlement'), $url2);
      $external_link = "";
      $external_link = $external_link1;
      return array(
        '#type' => 'markup',
        '#markup' => $external_link,
        '#cache' => array(
          'max-age' => 0
        ),
      );
    }
    elseif (in_array("authorised_user", $currentuserrole) && $nodeid != null) {

      if ($currentdate >= $startdate && $currentdate <= $enddate) {

        $url = Url::fromUri($base_url . '/node/' . $nodeid . '/edit');

        $external_link = \Drupal::l(t('Reimbursement Restructuring'), $url);

        return array(
          '#type' => 'markup',
          '#markup' => $external_link,
          '#cache' => array(
            'max-age' => 0
          ),
        );
      }
      else {
        return array(
          '#type' => 'markup',
          '#markup' => "",
          '#cache' => array(
            'max-age' => 0
          ),
        );
      }
    }
    else {

     return array(
          '#type' => 'markup',
          '#markup' => "",
          '#cache' => array(
            'max-age' => 0
          ),
        );
    }
  }

}
