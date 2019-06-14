<?php

namespace Drupal\coordinates\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Interface CoordinateFieldItemInterface.
 *
 * @package Drupal\coordinates\Plugin\Field\FieldType
 */
interface CoordinateFieldItemInterface extends FieldItemInterface {

  /**
   * Get the latitude.
   *
   * @return float|null
   *   A latitude.
   */
  public function getLatitude();

  /**
   * Get the longitude.
   *
   * @return float|null
   *   A longitude.
   */
  public function getLongitude();

  /**
   * Get the coordinate object.
   *
   * @return \Drupal\coordinates\Coordinate|null
   *   A Coordinate object.
   */
  public function toCoordinate();

}
