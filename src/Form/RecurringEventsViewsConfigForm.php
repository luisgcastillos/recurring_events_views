<?php

namespace Drupal\recurring_events_views\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RecurringEventsViewsConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'recurring_events_views_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return ['recurring_events_views.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('recurring_events_views.settings');

    $form['view_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('View Name'),
      '#description' => $this->t('The machine name of the view that contains recurring events. In most cases this will be "event" or "events".'),
      '#default_value' => $config->get('view_name') ?: $this->t(''),
    );

    $form['date_field_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Date Field Name'),
      '#description' => $this->t('The machine name of the date recur field.'),
      '#default_value' => $config->get('date_field_name') ?: $this->t(''),
    );

    $form['date_timezone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Date Timezone'),
      '#description' => $this->t('Enter the timezone that the event times should show up in. Here is a <a href="@link" target="_blank">list of supported timezones</a>.', ['@link' => 'https://www.php.net/manual/en/timezones.php']),
      '#default_value' => $config->get('date_timezone') ?: $this->t(''),
    );

    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('recurring_events_views.settings');
    $values = $form_state->getValues();

    $config->set('view_name', $values['view_name']);
    $config->set('date_field_name', $values['date_field_name']);
    $config->set('date_timezone', $values['date_timezone']);
    
    $config->save();

    parent::submitForm($form, $form_state);
  }
}