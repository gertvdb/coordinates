<?php

namespace Drupal\coordinates\Formatter;

use Drupal\coordinates\CoordinateInterface;

/**
 * CoordinateFormatter.
 */
class CoordinateFormatter implements CoordinateFormatterInterface {

  /**
   * {@inheritdoc}
   */
  public function format(CoordinateInterface $coordinates, string $format) {
    $replace = [
      self::LATITUDE_LITERAL => $coordinates->getLatitude(),
      self::LONGITUDE_LITERAL => $coordinates->getLongitude(),
    ];
    return strtr($format, $replace);
  }

}
