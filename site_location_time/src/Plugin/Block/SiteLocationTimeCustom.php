<?php

namespace Drupal\site_location_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'site location time custom' block.
 *
 * @Block(
 *   id = "site_location_time_custom_block",
 *   admin_label = @Translation("Site Location Time Custom Block"),
 *
 * )
 */
class SiteLocationTimeCustom extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $current_date_time = \Drupal::service('site_location_time.current_time_service')->getCurrentDateTime();
    $config = \Drupal::config('site_location_time.site_location_time_settings');
    $country = $config->get('country');
    $city = $config->get('city');
    return [
      '#theme' => 'site_location_time',
      '#title' => 'Site Location And Current Time',
      '#description' => 'It Provides Location and current time based on settings in site admin config form',
      '#current_date_time' => $current_date_time,
      '#country' => $country,
      '#city' => $city,
    ];
  }

  /**
   * @return int
   */
  public function getCacheMaxAge()
  {
    return 0;
  }
}
