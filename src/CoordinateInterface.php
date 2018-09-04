<?php

namespace Drupal\coordinates;

/**
 * Interface for storing coordinates.
 */
interface CoordinateInterface {

  /**
   * Longitude.
   *
   * @return double|null
   *   The longitude.
   */
  public function getLongitude();

  /**
   * Latitude.
   *
   * @return double|null
   *   The latitude.
   */
  public function getLatitude();

  /**
   * Spatial.
   *
   * @return double|null
   *   The latitude and longitude formatted for spatial search.
   */
  public function getSpatial();

  /**
   * To Array.
   *
   * @return array|null
   *   The latitude and longitude formatted as a keyed array.
   *   Array keys : 'latitude', 'longitude'
   */
  public function toArray();

}
