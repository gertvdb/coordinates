<?php

declare(strict_types = 1);

namespace Drupal\coordinates\Formatter;

use Drupal\coordinates\CoordinateInterface;

/**
 * Interface CoordinateFormatterInterface.
 */
interface CoordinateFormatterInterface {

  const LATITUDE_LITERAL = '%lat';
  const LONGITUDE_LITERAL = '%lng';

  /**
   * Format the interval.
   *
   * @param \Drupal\coordinates\CoordinateInterface $coordinates
   *   A coordinates object.
   * @param string $format
   *   The format consisting of only valid literals.
   *   Other items will be removed.
   */
  public function format(CoordinateInterface $coordinates, string $format);

}
