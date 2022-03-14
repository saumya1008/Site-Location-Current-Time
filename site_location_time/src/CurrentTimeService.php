<?php

namespace Drupal\site_location_time;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Component\Datetime\TimeInterface;

/**
 * Class CurrentTimeService
 * @package Drupal\site_location_time\Services
 */
class CurrentTimeService
{

  /**
   * Drupal\Core\Datetime\DateFormatter definition.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;
  /**
   * Drupal\Component\Datetime\TimeInterface definition.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $dateTime;
  /**
   * Constructor.
   */
  public function __construct(DateFormatter $date_formatter, TimeInterface $date_time)
  {
    $this->dateFormatter = $date_formatter;
    $this->dateTime = $date_time;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('date.formatter'),
      $container->get('datetime.time')
    );
  }

  /**
   * @return 
   */
  public function getCurrentDateTime()
  {
    $config = \Drupal::config('site_location_time.site_location_time_settings');
    $timezone = $config->get('timezone');
    $timestamp = $this->dateTime->getCurrentTime();
    $time = $this->dateFormatter->format($timestamp, 'custom', 'jS M Y - g:i A', $timezone);
    return $time;
  }
}
