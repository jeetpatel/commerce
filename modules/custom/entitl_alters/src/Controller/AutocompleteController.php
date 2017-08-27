<?php
namespace Drupal\ttn_entitl_alters\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines a route controller for entity autocomplete form elements.
 */
class AutocompleteController extends ControllerBase {

  /**
   * Handler for autocomplete request.
   */
  public function handleAutocomplete(Request $request, $field_name) {
    $usersearch=$request->query->get('q');
    $query = \Drupal::entityQuery('user');
    $group = $query->orConditionGroup()
            ->condition('field_name', "%" .$usersearch. "%", 'LIKE')
            ->condition('name',"%" . $usersearch. "%", 'LIKE')
            ->condition('roles',"%" . $usersearch. "%", 'LIKE')
            ->condition('mail',"%" .  $usersearch. "%", 'LIKE')
            ->condition('uid',"%" .  $usersearch. "%", 'LIKE');
    
    $userdata=$query->condition($group)->execute();
    $users=array();
    foreach($userdata as $uid){
        $this->usercontent($uid);
        $users[]=$this->usercontent($uid);
    }
    return new JsonResponse($users);
  }
  
  
  public function usercontent($uid) {
     $entitlementrecord = \Drupal::entityQuery('node')->condition('type', 'restructure_form')
                           ->condition('field_employee_reference', $uid)
                           ->execute();
     if(count($entitlementrecord)>0)
     {
        return false;
     }
     else{
     $account = \Drupal\user\Entity\User::load($uid); // pass your uid
      $email = $account->get('mail')->value;
      $name =  $account->get('name')->value;
      $fieldname =  $account->get('field_name')->value;
      $uid=    $account->get('uid')->value;
      $userdata= [
          'value' => $uid,
          'label' => $fieldname."-".$account->get('name')->value."(".$uid.")",
        ];
      return $userdata;
     }
 }

}