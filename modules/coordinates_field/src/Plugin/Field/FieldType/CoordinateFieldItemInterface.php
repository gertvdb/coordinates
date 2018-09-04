<?php

namespace Drupal\coordinates_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Interface CoordinateFieldItemInterface.
 *
 * @package Drupal\coordinates_field\Plugin\Field\FieldType
 */
interface CoordinateFieldItemInterface extends FieldItemInterface {

  /**
   * Get the latitude.
   *
   * @return double|null
   *   A latitude.
   */
  public function getLatitude();

  /**
   * Get the longitude.
   *
   * @return double|null
   *   A longitude.
   */
  public function getLongitude();

}
