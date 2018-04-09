<?php

namespace Drupal\qualtricsxm_embed\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_example_rgb' field type.
 *
 * @FieldType(
 *   id = "field_qualtricsxm_survey",
 *   label = @Translation("Field Qualtricsxm Survey"),
 *   module = "qualtricsxm_embed",
 *   description = @Translation("Render Qualtrics Survey iframe."),
 *   default_widget = "field_qualtricsxm_dropdown",
 *   default_formatter = "field_qualtricsxm_iframe",
 * )
 */
class QualtricsxmSurveyItem extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('something'));

    return $properties;
  }

}
