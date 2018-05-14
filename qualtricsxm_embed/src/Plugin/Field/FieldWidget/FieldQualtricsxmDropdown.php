<?php

namespace Drupal\qualtricsxm_embed\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Drupal\qualtricsxm\qualtricsxm;

/**
 * @file
 * Contains \Drupal\qualtricsxm_embed\Plugin\Field\FieldWidget\FieldQualtricsxmDropdown.
 */

/**
 * {@inheritdoc}
 */
class FieldQualtricsxmDropdown extends WidgetBase {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $value = isset($items[$delta]->value) ? $items[$delta]->value : NULL;

    $surveys = qualtricsxm_get_surveys();

    if (!empty($surveys)) {
      foreach ($surveys as $survey_id => $survey_info) {
        $widget_options[$survey_id] = $survey_info['surveyname'];
      }
    }
    // Build the element render array.
    $element += [
      '#type' => 'select',
      '#default_value' => $value,
      '#options' => $widget_options,
      '#empty_option' => '--',
    ];

    return ['value' => $element];

  }

}
