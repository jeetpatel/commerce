<?php

namespace Drupal\chip4dyno\Helper;

use Drupal\Core\Database\Database;

class ChipdHelper {
  
  /** @var \Drupal\Core\Database\Connection */
  private $database;
  
  public $activeLanguage;
  
  public $languageArray;
      
      function __construct() {
    $this->database = Database::getConnection();
  }
  
  public static function Instance()
  {
      static $inst = null;
      if ($inst === null) {
          $inst = new ChipdHelper();
      }
      return $inst;
  }
  /**
   * Get taxonomy term's parent id.
   * @param type $termID
   * @return int
   */
  function getParentID($termID) {
    $query = $this->database->select('taxonomy_term_field_data', 'td')->fields('td');
    $this->activeLanguage = $this->getActiveLanguage();
    $query->condition('langcode', $this->activeLanguage);
    $query->condition('vid','category');
    $query->condition('td.tid',$termID);
    $result = $query->execute()->fetch();
    if (!empty($result->tid)) {
      return $result->tid;
    } else {
      return 0; //Return parent ID
    }
    
  }
  /**
   * Get terms by parent id or term's parent id.
   * @param type $parentID
   * @param type $termID
   * @return type
   */
  function getTerms($parentID = 0,$termID = null){
    $this->activeLanguage = $this->getActiveLanguage();
    $query = $this->database->select('taxonomy_term_field_data', 'td')
      ->fields('td');
    $query->join('taxonomy_term_hierarchy', 'tr', 'tr.tid = td.tid');
    $query->condition('td.langcode', $this->activeLanguage);
    $query->condition('td.vid','category');
    if ($parentID >= 0) {
      $query->condition('tr.parent',$parentID);
    }
    elseif (!empty($termID)) {
      $parentID = $this->getParentID($termID);
      $query->condition('tr.parent',$parentID);
    } else {
      $query->condition('tr.parent','-1');
    }
    $terms = $query->execute()->fetchAll();
    $taxonomy = [];
    foreach($terms as $val){
      $taxonomy[$val->tid] = $val->name;
    }
    return $taxonomy;
  }
  /**
   * Get current active language.
   *
   * @return string
   *    Current active language.
   */
  public function getActiveLanguage() {
    return $this->activeLanguage = (!empty($this->activeLanguage)) ? $this->activeLanguage : \Drupal::languageManager()->getCurrentLanguage()->getId();
  }
  
  /**
   * Return languages configuration.
   *
   * @return array
   *    Return languages array.
   */
  public function getLanguages() {
    if (count($this->languageArray) > 0) {
      return $this->languageArray;
    }
    // For the multilingual website.
    $lanuages = \Drupal::languageManager()->getLanguages();
    foreach ($lanuages as $lang) {
      $this->languageArray[$lang->getId()] = $lang->getName();
    }
    return $this->languageArray;
  }  
}