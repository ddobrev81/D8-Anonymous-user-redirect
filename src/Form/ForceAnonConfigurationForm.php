<?php

/**
 * @file
 * Contains \Drupal\slakb_general\Form\forceanonConfigurationForm.
 */

namespace Drupal\slakb_general\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configuration form for ForceAnon module.
 */
class ForceAnonConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'slakb_general_configuration';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['slakb_general.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Allow users to include CSS from the current theme.
    $form['settings']['redirect_path'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Redirect to'),
      '#description' => $this->t('Specify a redirect path. Default is "/user".'),
      '#default_value' => $this->config('slakb_general.settings')->get('redirect_path'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::service('config.factory')->getEditable('slakb_general.settings')
      ->set('redirect_path', $form_state->getValue('redirect_path'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
