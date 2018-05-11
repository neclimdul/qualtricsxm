<?php

namespace Drupal\qualtricsxm\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\qualtricsxm\Qualtricsxm;

/**
 * @file
 * Contains \Drupal\qualtricsxm\Controller\DefaultController.
 */

/**
 * Default controller for the qualtricsxm module.
 */
class DefaultController extends ControllerBase
{

  public function qualtricsxm_survey_page ($survey_id)
  {
    //$qualtrics = new Qualtricsxm(QUALTRICSXM_BASE_URL, QUALTRICSXM_API_TOKEN);
    $qualtrics = qualtricsxm_static();
    $survey_data = $qualtrics->getSurvey($survey_id);

    if (!$survey_data) {
      return $this->t('Survey is unavailable.');
    }
    //$user = \Drupal::currentUser();
    $embed_url = get_base_url() . "/$survey_id";
    $qualtricsxm_embed_width = get_config_width_height()['width'];
    $qualtricsxm_embed_height = get_config_width_height()['height'];
    return [
      '#markup' => $this->t("<iframe src=\"$embed_url\" height=\"$qualtricsxm_embed_height\" width=\"$qualtricsxm_embed_width\" frameborder=\"0\" scrolling=\"no\" class=\"qualtrics_iframe\"></iframe>"),
    ];
  }

  /**
   * Set page title.
   * Comment it out if no needs for title.
   * @param string $survey_id
   *
   * @return mixed
   *    string|null
   */
  public function getTitle ($survey_id)
  {
    $survey = qualtricsxm_get_survey($survey_id);
    $title = !empty($survey->name) ? $survey->name : NULL;
    return $title;
  }

  /**
   * Get surveys list by survey token.
   * @return array|string
   */
  public function qualtricsxm_surveys_list ()
  {
    return qualtricsxm_get_survey_list_table();
  }
}
