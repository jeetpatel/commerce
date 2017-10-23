<?php

/**
 * @filesource
 */
namespace Drupal\chip4dyno\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\chip4dyno\Helper\ChipdHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Database\Database;

class CategoryController extends ControllerBase {
  
  public $database;
  public $helper;
  /**
   * Constructor.
   */
  public function __construct() {
    $this->helper = ChipdHelper::Instance();
    $this->database = Database::getConnection();
  }

  /**
   * Create function.
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('path.alias_manager'));
  }
  
  /**
   * Get Category list.
   *
   * @param type $parent_id
   * @param type $term_id
   * @return JsonResponse
   */
  public function getCategory($parent_id = 0, $term_id = NULLs) {
    $terms = $this->helper->getTerms($parent_id,$term_id);
    return new JsonResponse([
      'result' => $terms
        ], 200);
  }
  /**
   * Get tuning options by tuning type.
   *
   * @param type $tuning_id
   * @return type
   */
  public function getTuningOptions($tuning_id) {
    $output = FALSE;
    $query = $this->database->select('taxonomy_term__field_tuning_type','t');
    $query->join('taxonomy_term_field_data','td','td.tid = t.entity_id');
    $query->fields('t',['entity_id']);
    $query->fields('td',['name']);
    $query->condition('td.vid', 'tuning_options');
    $query->condition('t.field_tuning_type_target_id', $tuning_id);
    $result = $query->execute()->fetchAll();
    if ($result) {
    $html = '<div id="edit-field-tuning-options" class="webform-options-display-one-column form-checkboxes">';
      foreach($result as $res) {
        $tid = $res->entity_id;
        $name = $res->name;
        
$html.='<div class="js-form-item form-item js-form-type-checkbox form-type-checkbox js-form-item-field-tuning-options-'.$tid.' form-item-field-tuning-options-83">
        <input data-drupal-selector="edit-field-tuning-options-'.$tid.'" type="checkbox" id="edit-field-tuning-options-'.$tid.'" name="field_tuning_options['.$tid.']" value="'.$tid.'" class="form-checkbox">

        <label for="edit-field-tuning-options-'.$tid.'" class="option">'.$name.'</label>
      </div>';
      }
    $html.='</div>';
    } else {
      $html = 'no_result';
    }
    //echo $html;
    return new JsonResponse([
      'result' => $html
    ], 200);  
  }
}

