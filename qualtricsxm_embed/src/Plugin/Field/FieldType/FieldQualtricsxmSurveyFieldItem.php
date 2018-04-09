<?php///**
// * @file
// * Contains \Drupal\qualtricsxm_embed\Plugin\Field\FieldType\FieldQualtricsxmSurveyFieldItem.
// */
//
//namespace Drupal\qualtricsxm_embed\Plugin\Field\FieldType;
//
//use Drupal\Core\Field\FieldItemBase;
//use Drupal\Core\Field\FieldStorageDefinitionInterface;
//use Drupal\Core\TypedData\DataDefinition;
//
///**
// * Plugin implementation of the 'field_qualtricsxm_survey' field type.
// *
// * @FieldType(
// *   id = "field_qualtricsxm_survey",
// *   label = @Translation("QualtricsXM Survey Dropdown"),
// *   description = @Translation("This field render a iframe page."),
// *   default_widget = "field_qualtricsxm_dropdown",
// *   default_formatter = "field_qualtricsxm_iframe"
// * )
// */
//class FieldQualtricsxmSurveyFieldItem extends FieldItemBase {
//
//  /**
//   * {@inheritdoc}
//   */
//  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
//    $properties['value'] = DataDefinition::create('field_qualtricsxm_survey')
//      ->setLabel(t('QualtricsXM Survey Dropdown'))
//      ->setRequired(TRUE);
//
//    return $properties;
//  }
//
//  /**
//   * {@inheritdoc}
//   */
//  public static function schema(FieldStorageDefinitionInterface $field_definition) {
//    $columns = array(
//      'sid' => array('type' => 'varchar', 'length' => 50, 'not null' => FALSE),
//    );
//    $indexes = array(
//      'sid' => array('sid'),
//    );
//    return array(
//      'columns' => $columns,
//      'indexes' => $indexes,
//    );
//  }
//
//  /**
//   * {@inheritdoc}
//   */
//  public function isEmpty() {
//    $value = $this->get('value')->getValue();
//    return $value === NULL || $value === '';
//  }
//
//}
