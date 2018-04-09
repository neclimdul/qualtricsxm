<?php /**
 * @file
 * Contains \Drupal\qualtricsxm_embed\Plugin\Field\FieldWidget\FieldQualtricsxmDropdown.
 */

namespace Drupal\qualtricsxm_embed\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Drupal\qualtricsxm\qualtricsxm;

/**
 * @FieldWidget(
 *  id = "field_qualtricsxm_dropdown",
 *  label = @Translation("QualtricsXM Survey Dropdown"),
 *  field_types = {"field_qualtricsxm_survey"},
 *  default_formatter = "field_qualtricsxm_iframe"
 *
 * )
 */
class FieldQualtricsxmDropdown extends WidgetBase {

  /**
   * @FIXME
   * Move all logic relating to the field_qualtricsxm_dropdown widget into this class.
   * For more information, see:
   *
   * https://www.drupal.org/node/1796000
   * https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21WidgetInterface.php/interface/WidgetInterface/8
   * https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21WidgetBase.php/class/WidgetBase/8
   */

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $value = isset($items[$delta]->value) ? $items[$delta]->value : NULL;
    $field_settings = $this->getFieldSettings();
    //$range = range($field_settings['min'], $field_settings['max']);

    $surveys = qualtricsxm_get_surveys();

    if (!empty($surveys)) {
      foreach ($surveys as $survey_id => $survey_info) {
        $widget_options[$survey_id] = $survey_info['surveyname'];
      }
    }
    // Build the element render array.
    $element += array(
      '#type' => 'select',
      '#default_value' => $value,
      '#options' => $widget_options,
      '#empty_option' => '--',
    );
    // Add prefix and suffix.
//    if ($field_settings['prefix']) {
//      $prefixes = explode('|', $field_settings['prefix']);
//      $element['#field_prefix'] = FieldFilteredMarkup::create(array_pop($prefixes));
//    }
//    if ($field_settings['suffix']) {
//      $suffixes = explode('|', $field_settings['suffix']);
//      $element['#field_suffix'] = FieldFilteredMarkup::create(array_pop($suffixes));
//    }
    return array('value' => $element);

  }

}
