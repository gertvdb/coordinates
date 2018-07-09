<?php

namespace Drupal\coordinates;

/**
 * Coordinate.
 *
 * A coordinate object to store coordinates.
 */
final class Coordinate implements CoordinateInterface {

  /**
   * The latitude.
   *
   * @var float|null
   */
  protected $latitude;

  /**
   * The longitude.
   *
   * @var float|null
   */
  protected $longitude;

  /**
   * The latitude and longitude for spatial searches.
   *
   * @var string|null
   */
  protected $spatial;

  /**
   * Constructor.
   */
  public function __construct(float $latitude = NULL, float $longitude = NULL) {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }

  /**
   * Longitude.
   *
   * @return float|null
   *   The longitude.
   */
  public function getLongitude() {
    return $this->longitude ? $this->longitude : NULL;
  }

  /**
   * Latitude.
   *
   * @return float|null
   *   The latitude.
   */
  public function getLatitude() {
    return $this->latitude ? $this->latitude : NULL;
  }

  /**
   * Set longitude.
   *
   * @param float|null $longitude
   *   The longitude.
   */
  public function setLongitude($longitude = NULL) {
    $this->longitude = $longitude;
  }

  /**
   * Set latitude.
   *
   * @param float|null $latitude
   *   The longitude.
   */
  public function setLatitude($latitude = NULL) {
    $this->latitude = $latitude;
  }

  /**
   * Spatial.
   *
   * @return string|null
   *   The latitude and longitude formatted for spatial search.
   */
  public function getSpatial() {

    // Check for valid coordinates.
    if (!$this->getLatitude() || !$this->getLongitude()) {
      return NULL;
    }

    return $this->getLatitude() . ',' . $this->getLongitude();
  }

}
