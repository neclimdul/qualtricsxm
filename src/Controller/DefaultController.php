<?php /**
 * @file
 * Contains \Drupal\qualtricsxm\Controller\DefaultController.
 */

namespace Drupal\qualtricsxm\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\qualtricsxm\Qualtricsxm;
use Drupal\Core\Url;
use Drupal\Core\Link;
/**
 * Default controller for the qualtricsxm module.
 */
class DefaultController extends ControllerBase {

  public function qualtricsxm_survey_page($survey_id) {
    $qualtrics = new Qualtricsxm(QUALTRICSXM_BASE_URL, QUALTRICSXM_API_TOKEN);
    $survey_data = $qualtrics->getSurvey($survey_id);

    if (!$survey_data) {
      return t('Survey is unavailable.');
    }
    //$user = \Drupal::currentUser();
    $embed_url = QUALTRICSXM_EMBED_URL . "/$survey_id";
    $qualtricsxm_embed_width = !empty(\Drupal::config('qualtricsxm.settings')->get('qualtricsxm_embed_width')) ? \Drupal::config('qualtricsxm.settings')->get('qualtricsxm_embed_width') : "100%";
    $qualtricsxm_embed_height = !empty(\Drupal::config('qualtricsxm.settings')->get('qualtricsxm_embed_height')) ? \Drupal::config('qualtricsxm.settings')->get('qualtricsxm_embed_height') : "900";
    return [
      '#markup' => $this->t("<iframe src=\"$embed_url\" height=\"$qualtricsxm_embed_height\" width=\"$qualtricsxm_embed_width\" frameborder=\"0\" scrolling=\"no\" class=\"qualtrics_iframe\"></iframe>"),
    ];
  }

  /**
   * Set page title.
   * Comment it out if no needs for title.
   * @param string $survey_id
   * @return mixed
   *  string|null
   */
  public function getTitle($survey_id) {
    $survey = qualtricsxm_get_survey($survey_id);
    $title = !empty($survey->name) ? $survey->name : NULL;
    return $title;
  }

  /**
   * Get surveys list by survey token.
   * @return array|string
   */
  public function qualtricsxm_surveys_list() {

    $surveys = qualtricsxm_get_surveys();

    if (!$surveys) {
      return "Qualtrics not connected.";
    }

    $table = &drupal_static(__FUNCTION__);

    if (!isset($table)) {
      if ($cache = \Drupal::cache()->get('admin_table_cache')) {
        $table = $cache->data;
      }
      else {
        foreach ($surveys as $survey) {
          $id = $survey['id'];
          $submissions = qualtricsxm_count_survey_submissions($id);
          $survey['auditable'] = empty($submissions->auditable) ? NULL : $submissions->auditable;
          $survey['generated'] = empty($submissions->generated) ? NULL : $submissions->generated;
          $survey['deleted'] = empty($submissions->deleted) ? NULL : $submissions->deleted;
          $survey['id'] = t("<a href=/qualtricsxm/survey/$id>" . $id . "</a>");
          $row[] = $survey;
        }
        $table = [
          '#theme' => 'table',
          '#header' => [
            t('Name'),
            t('Survey ID'),
            t('User ID'),
            t('Last Updated'),
            t('is Active'),
            t('Auditable'),
            t('Generated'),
            t('Deleted'),
          ],
          '#rows' => $row,
        ];
        // 4hours.
        \Drupal::cache()->set('admin_table_cache', $table, time() + 60 * 60 * 4);
      }
    }

    return $table;
  }

}