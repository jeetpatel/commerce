<?php

namespace Drupal\ttn_entitl_alters\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
/**
 * Configure custom settings for this site.
 */
class TtnEntitlementDateForm extends ConfigFormBase {

    /**
     * Constructor for SocialFeedsBlockForm.
     *
     * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
     *   The factory for configuration objects.
     */
    public function __construct(ConfigFactoryInterface $config_factory) {

        parent::__construct($config_factory);
    }

    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId() {
        return 'ttn_entitlement_valid_date_form';
    }

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames() {
        return ['config.ttn_entitlement_date'];
    }

    /**
     * Form constructor.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The form structure.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('config.ttn_entitlement_date');
        $form['ttn_entitlementdate'] = array(
            '#type' => 'fieldset',
            '#title' => $this->t('Edit Cut-Off Dates'),
            '#weight' => 50,
            '#collapsible' => TRUE,
            '#collapsed' => TRUE,
        );

       $form['ttn_entitlementdate']['startdate'] = array(
           '#title' => t('Start Date'),
           '#type' => 'date',
           '#default_value' => $config->get('entitle.startdate'),
           '#required' => TRUE,
       );
       
       $form['ttn_entitlementdate']['enddate'] = array(
           '#title' => t('End Date'),
           '#type' => 'date',
           '#default_value' => $config->get('entitle.enddate'),
           '#required' => TRUE,
       );

        $form['ttn_entitlementdate']['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Save'),
             );
       
           return $form;
           //   return parent::buildForm($form, $form_state);
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = $this->config('config.ttn_entitlement_date');
 
        $config->set('entitle.startdate', $form_state->getValue('startdate'));
 
        $config->set('entitle.enddate', $form_state->getValue('enddate'));
 
        $config->save();
        drupal_set_message('Cut-Off Dates have been updated');
       // return parent::submitForm($form, $form_state);
    }

}
