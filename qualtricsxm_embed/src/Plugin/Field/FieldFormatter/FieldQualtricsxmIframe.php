<?php /**
 * @file
 * Contains \Drupal\qualtricsxm_embed\Plugin\Field\FieldFormatter\FieldQualtricsxmIframe.
 */

namespace Drupal\qualtricsxm_embed\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
/**
 * @FieldFormatter(
 *  id = "field_qualtricsxm_iframe",
 *  label = @Translation("QualtricsXM iframe-embedding"),
 *  field_types = {"field_qualtricsxm_survey"},
 *  default_widget = "field_qualtricsxm_dropdown",
 * )
 */
class FieldQualtricsxmIframe extends FormatterBase {

  /**
   * @FIXME
   * Move all logic relating to the field_qualtricsxm_iframe formatter into this
   * class. For more information, see:
   *
   * https://www.drupal.org/node/1805846
   * https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21FormatterInterface.php/interface/FormatterInterface/8
   * https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21FormatterBase.php/class/FormatterBase/8
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($items as $delta => $item) {

      $elements[$delta] = array(
        '#markup' => t("<iframe src=\"https://au1.qualtrics.com/jfe/form/$item->value\" height=\"900\" width=\"100%\" frameborder=\"0\" scrolling=\"yes\" class=\"qualtrics_iframe\"></iframe>"),
      );
    }

    return $elements;
  }
}
