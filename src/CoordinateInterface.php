<?php

namespace Drupal\coordinates;

/**
 * Interface for storing coordinates.
 */
interface CoordinateInterface {

  /**
   * Longitude.
   *
   * @return float|null
   *   The longitude.
   */
  public function getLongitude();

  /**
   * Latitude.
   *
   * @return float|null
   *   The latitude.
   */
  public function getLatitude();

  /**
   * Spatial.
   *
   * @return float|null
   *   The latitude and longitude formatted for spatial search.
   */
  public function toSpatial();

  /**
   * To Array.
   *
   * @return array|null
   *   The latitude and longitude formatted as a keyed array.
   *   Array keys : 'latitude', 'longitude'
   */
  public function toArray();

}
