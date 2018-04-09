<?php

/**
 * @file
 * Contains \Drupal\qualtricsxm\Form\QualtricsxmConfigSettings.
 */

namespace Drupal\qualtricsxm\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class QualtricsxmConfigSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'qualtricsxm_config_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('qualtricsxm.settings');

    foreach (Element::children($form) as $variable) {
      $config->set($variable, $form_state->getValue($form[$variable]['#parents']));
    }
    $config->save();

    if (method_exists($this, '_submitForm')) {
      $this->_submitForm($form, $form_state);
    }

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['qualtricsxm.settings'];
  }

  public function buildForm(array $form, \Drupal\Core\Form\FormStateInterface $form_state) {

    $form['qualtricsxm_api_token'] = [
      '#type' => 'textfield',
      '#title' => t('API token'),
      '#required' => TRUE,
      '#default_value' => \Drupal::config('qualtricsxm.settings')->get('qualtricsxm_api_token'),
      '#description' => t('Your API token. qualtricsxm_embed module requires API token.'),
    ];

    $form['qualtricsxm_datacenter'] = [
      '#type' => 'textfield',
      '#title' => t('Datacenter ID'),
      '#required' => TRUE,
      '#default_value' => \Drupal::config('qualtricsxm.settings')->get('qualtricsxm_datacenter'),
      '#description' => t('Your datacenter ID, e.g. au2.') . " <a href='https://api.qualtrics.com/docs/root-url' target='_blank'>" . "Find your DataCenter</a>",
    ];

    $form['qualtricsxm_organization_id'] = [
      '#type' => 'textfield',
      '#title' => t('Organization ID'),
      '#default_value' => \Drupal::config('qualtricsxm.settings')->get('qualtricsxm_organization_id'),
      '#description' => t('Your datacenter.') . " <a href='https://api.qualtrics.com/docs/finding-qualtrics-ids' target='_blank'>" . "Find your Organization ID</a>",
    ];

    $form['qualtricsxm_secure_embed'] = [
      '#type' => 'checkbox',
      '#title' => t('Secure embedding'),
      '#default_value' => \Drupal::config('qualtricsxm.settings')->get('qualtricsxm_secure_embed'),
      '#description' => t('Whether to use https:// for embedding a survey or not.'),
    ];

    return parent::buildForm($form, $form_state);
  }

}
?>
