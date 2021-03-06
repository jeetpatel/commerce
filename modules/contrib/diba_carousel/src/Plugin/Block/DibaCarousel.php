<?php

namespace Drupal\diba_carousel\Plugin\Block;

use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Component\Utility\Unicode;
use Drupal\image\Entity\ImageStyle;

/**
 * Provides a Diba carousel Block.
 *
 * @Block(
 *   id = "diba_carousel",
 *   admin_label = @Translation("Diba carousel")
 * )
 */
class DibaCarousel extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    return [
      '#theme' => 'block__diba_carousel',
      'result' => $this->getResult($config),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return Cache::mergeContexts(
      parent::getCacheContexts(),
      ['user.node_grants:view', 'languages']
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(
      parent::getCacheTags(),
      ['node_list', 'config:block.block.dibacarousel']
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'content_types' => ['article' => 1, 'page' => 1],
      'publishing_options' => ['status' => 1, 'promote' => 1],
      'image' => 'field_image',
      'title' => 'title',
      'image_style' => '',
      'url' => 'nid',
      'description' => 'body',
      'description_truncate' => 300,
      'order' => '',
      'order_direction' => 'ASC',
      'limit' => 10,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['diba_carousel_settings'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Diba carousel configuration'),
    ];

    $form['diba_carousel_settings']['content_types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Content types'),
      '#default_value' => $config['content_types'],
      '#options' => $this->getNodeTypes(),
      '#multiple' => TRUE,
      '#description' => $this->t('Check the content types that you want to appear in the carousel.'),
    ];

    // Default publishing options.
    $options = [
      'status' => $this->t('Published'),
      'promote' => $this->t('Promoted to front page'),
      'sticky' => $this->t('Sticky at top of lists'),
    ];
    // Add custom publishing options (custom_pub module integration).
    $moduleHandler = \Drupal::service('module_handler');
    if ($moduleHandler->moduleExists('custom_pub')) {
      $publish_types = \Drupal::entityTypeManager()
        ->getStorage('custom_publishing_option')
        ->loadMultiple();
      foreach ($publish_types as $publish_type) {
        $options[$publish_type->id()] = $publish_type->label();
      }
    }
    $form['diba_carousel_settings']['publishing_options'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Publishing options'),
      '#default_value' => $config['publishing_options'],
      '#options' => $options,
      '#multiple' => TRUE,
      '#description' => $this->t('Publishing options to filter content in the carousel.'),
    ];

    $form['diba_carousel_settings']['image'] = [
      '#type' => 'select',
      '#title' => $this->t('Image field'),
      '#options' => $this->getOptionTypes(['image']),
      '#default_value' => $config['image'],
      '#empty_option' => $this->t('- None -'),
    ];
    $form['diba_carousel_settings']['image_style'] = [
      '#type' => 'select',
      '#title' => $this->t('Image style'),
      '#options' => $this->getImageStyles(),
      '#default_value' => $config['image_style'],
      '#empty_option' => $this->t('- None -'),
      '#description' => $this->t('Use an image style for scale, resize or crop images.'),
    ];
    $form['diba_carousel_settings']['title'] = [
      '#type' => 'select',
      '#title' => $this->t('Title field'),
      '#options' => $this->getOptionTypes(['string']),
      '#default_value' => $config['title'],
      '#empty_option' => $this->t('- None -'),
    ];

    $url_options = ['nid' => $this->t('Node content (nid)')];
    $url_options = array_merge($url_options, $this->getOptionTypes(['link']));

    $form['diba_carousel_settings']['url'] = [
      '#type' => 'select',
      '#title' => $this->t('Link field'),
      '#options' => $url_options,
      '#default_value' => $config['url'],
      '#empty_option' => $this->t('- None -'),
    ];
    $form['diba_carousel_settings']['description'] = [
      '#type' => 'select',
      '#title' => $this->t('Description field'),
      '#options' => $this->getOptionTypes([
        'text_with_summary', 'text_long', 'string',
      ]),
      '#default_value' => $config['description'],
      '#empty_option' => $this->t('- None -'),
    ];
    $form['diba_carousel_settings']['description_truncate'] = [
      '#type' => 'number',
      '#title' => $this->t('Maximum number of characters in description field'),
      '#default_value' => $config['description_truncate'],
      '#description' => $this->t("Truncates the description safely to a maximum number of characters. The truncation strip html tags and attempt to truncate on a word boundary. Use 0 for unlimited."),
    ];
    $form['diba_carousel_settings']['order'] = [
      '#type' => 'select',
      '#title' => $this->t('Order by'),
      '#options' => $this->getOptionTypes([
        'integer', 'created', 'changed', 'datetime',
      ]),
      '#default_value' => $config['order'],
      '#empty_option' => $this->t('- None -'),
    ];
    $form['diba_carousel_settings']['order_direction'] = [
      '#type' => 'select',
      '#title' => $this->t('Order direction'),
      '#options' => [
        'ASC' => $this->t('Ascending'),
        'DESC' => $this->t('Descending'),
        'RANDOM' => $this->t('Random'),
      ],
      '#default_value' => $config['order_direction'],
    ];
    $form['diba_carousel_settings']['limit'] = [
      '#type' => 'number',
      '#title' => $this->t('Max number of elements'),
      '#default_value' => $config['limit'],
      '#description' => $this->t('The maximum number of elements to show in the carousel.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $config = $form_state->getValues();
    if (isset($config['diba_carousel_settings'])) {
      $config_fields = [
        'content_types',
        'publishing_options',
        'image',
        'image_style',
        'title',
        'url',
        'description',
        'description_truncate',
        'order',
        'order_direction',
        'limit',
      ];
      foreach ($config_fields as $config_field) {
        $this->setConfigurationValue(
          $config_field,
          $config['diba_carousel_settings'][$config_field]
        );
      }
    }
  }

  /**
   * List of fields grouped by type.
   */
  private function getFields() {
    $entityFieldManager = \Drupal::service('entity_field.manager');
    $fields = $entityFieldManager->getFieldStorageDefinitions('node');
    $options = [];
    foreach ($fields as $field) {
      $label = $field->getLabel();
      $name = $field->getName();
      $type = $field->getType();
      $options[$type][$name] = $label . ' (' . $name . ')';
    }

    return $options;
  }

  /**
   * List of image styles.
   */
  private function getImageStyles() {
    $styles = \Drupal::entityTypeManager()->getStorage('image_style')->loadMultiple();
    $options = [];
    foreach ($styles as $key => $style) {
      $options[$key] = $key;
    }

    return $options;
  }

  /**
   * List of fields filtered by type.
   */
  private function getOptionTypes($types) {
    $fields = $this->getFields();

    $options = [];
    foreach ($types as $type) {
      if (isset($fields[$type])) {
        $options = array_merge($options, $fields[$type]);
      }
    }

    return $options;
  }

  /**
   * Private Function getNodeTypes.
   */
  private function getNodeTypes() {
    // Load node types.
    $node_types = NodeType::loadMultiple();
    $options = [];
    foreach ($node_types as $node_type) {
      $options[$node_type->id()] = $node_type->label();
    }

    return $options;
  }

  /**
   * Get the carousel nodes.
   */
  private function getResult($config) {
    $result = '';
    if (isset($config['content_types'])) {

      // Get content types from config.
      $bundles = [];
      $nodeTypes = $this->getNodeTypes();
      foreach ($config['content_types'] as $key => $value) {
        // Validate that the node type exists to prevent crash the site when
        // user deletes a content types without change the block configuration.
        if (!empty($value) && isset($nodeTypes[$key])) {
          $bundles[] = $key;
        }
      }

      if (!empty($bundles)) {

        $query = \Drupal::entityQuery('node');
        $query->condition('type', array_values($bundles), 'IN');

        // Get publishing options.
        if (isset($config['publishing_options']) && !empty($config['publishing_options'])) {
          foreach ($config['publishing_options'] as $key => $value) {
            if (!empty($value)) {
              // Add query condition and filter by publishing option.
              $query->condition($key, 1);
            }
          }
        }

        if (isset($config['order']) && !empty($config['order'])) {
          if ($config['order_direction'] == 'ASC' || $config['order_direction'] == 'DESC') {
            $query->sort($config['order'], $config['order_direction']);
          }
          else {
            $query->sort($config['order']);
          }
        }
        // We don't need to select an order field to order by rand.
        if (isset($config['order_direction']) && $config['order_direction'] == 'RANDOM') {
          $query->addTag('random_order');
        }

        if (isset($config['limit']) && !empty($config['limit'])) {
          $query->range(0, $config['limit']);
        }

        $entity_ids = $query->execute();
        if (!empty($entity_ids)) {
          foreach ($entity_ids as $eid) {
            $node = Node::load($eid);

            $description = '';
            if (!empty($config['description'])) {
              $description = trim(strip_tags($node->{$config['description']}->value));
              if (!empty($config['description_truncate']) && $config['description_truncate'] > 0) {
                $description = Unicode::truncate($description, $config['description_truncate'], TRUE, TRUE);
              }
            }

            $url = '';
            if ($config['url'] == 'nid') {
              $url = Url::fromRoute('entity.node.canonical', ['node' => $eid]);
            }
            elseif (!empty($node->{$config['url']})) {
              $url = $node->{$config['url']}->first()->getUrl();
            }

            $image_width = $image_height = $image_uri = '';
            if (!empty($config['image'])) {

              $image_obj = $node->{$config['image']}->entity;
              if (!empty($image_obj)) {
                $image_uri = $image_obj->getFileUri();
              }
              else {
                // Image not found, try the default image.
                $default_image = $node->{$config['image']}->getSetting('default_image');
                if (!empty($default_image) && isset($default_image['uuid'])) {
                  $default_entity = \Drupal::entityManager()->loadEntityByUuid('file', $default_image['uuid']);
                  $image_uri = $default_entity->getFileUri();
                }
              }

              if (!empty($image_uri)) {
                // Use an image style instead of the original file.
                if (!empty($config['image_style'])) {
                  $style = ImageStyle::load($config['image_style']);
                  $image_derivative = $style->buildUri($image_uri);
                  // Create derivative if necessary.
                  if (!file_exists($image_derivative)) {
                    $style->createDerivative($image_uri, $image_derivative);
                  }
                  $image_uri = $image_derivative;
                }

                // Check if the image is valid.
                $image = \Drupal::service('image.factory')->get($image_uri);
                if ($image->isValid()) {
                  $image_width = $image->getWidth();
                  $image_height = $image->getHeight();
                }
              }
            }

            $result[$eid] = [
              'image' => $image_uri,
              'image_width' => $image_width,
              'image_height' => $image_height,
              'title' => strip_tags($node->{$config['title']}->value),
              'url' => $url,
              'description' => $description,
            ];
          }
        }
      }

    }

    return $result;
  }

}
