<?php

namespace Drupal\chip_dyno_home;

use Drupal\block\Entity\Block;

/**
 * Class DefaultService.
 *
 * @package Drupal\chip_dyno_home
 */
class TwigExtension extends \Twig_Extension {
  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'block_display';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('account_menu', array($this, 'account_menu'), array('is_safe' => array('html'))),
    );
  }

  public function account_menu() {
    //Get current user.
    $user = \Drupal::currentUser();
    // Check for logged_in user.
    if ($user->id()) {
      return array('first_link' => '/user/'.$user->id(),
        'first_title' => 'MY ACCOUNT',
        'first_label' => 'MY ACCOUNT',
        'second_class' => 'topLogout',
        'second_link' => '/user/logout',
        'second_title' => 'Logout',
        'second_label' => 'LOGOUT',);
    } else {
      return array('first_link' => '/user/login',
        'first_title' => 'Click to go to the login form',
        'first_label' => 'LOGIN',
        'second_class' => 'topRegister',
        'second_link' => '/user/register',
        'second_title' => 'Register for an account',
        'second_label' => 'REGISTER',);
    }
    
  }
}