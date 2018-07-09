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
   * Set longitude.
   *
   * @param float|null $longitude
   *   The longitude.
   */
  public function setLongitude($longitude = NULL);

  /**
   * Set latitude.
   *
   * @param float|null $latitude
   *   The longitude.
   */
  public function setLatitude($latitude = NULL);

  /**
   * Spatial.
   *
   * @return float|null
   *   The latitude and longitude formatted for spatial search.
   */
  public function getSpatial();

}
