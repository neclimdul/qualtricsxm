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
  public function viewElements(FieldItemListInterface $items, $langcode) {
    //var_dump($items->getSetting('auto'));
    $iframe_auto = $items->getSetting('auto')['qualtricsxm_embed_enable_iframe_auto_resize'];
    $iframe_width  =  !empty($items->getSetting('auto')['qualtricsxm_embed_width']) ?
      $items->getSetting('auto')['qualtricsxm_embed_width']: "100%";
    $iframe_height  = !empty($items->getSetting('auto')['qualtricsxm_embed_height']) ?
      $items->getSetting('auto')['qualtricsxm_embed_height'] : "900";
    $elements = array();

    foreach ($items as $delta => $item) {
      if (!empty($iframe_auto)) {

        $elements['#attached']= [
          'library' => ['qualtricsxm_embed/qualtricsxm-libraries'],
        ];
        $elements[$delta] = array(
          '#markup' => t("<iframe src=\"https://au1.qualtrics.com/jfe/form/$item->value\" height=\"\" width=\"\" frameborder=\"0\" scrolling=\"yes\" class=\"qualtrics_iframe\"></iframe>"),
        );
      } else {
        $elements[$delta] = array(
          '#markup' => t("<iframe src=\"https://au1.qualtrics.com/jfe/form/$item->value\" height=\"$iframe_height\" width=\"$iframe_width\" frameborder=\"0\" scrolling=\"yes\" ></iframe>"),
        );

      }
    }
    return $elements;
  }
}
