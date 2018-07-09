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
   *
   * @param float $latitude
   *   The latitude of the coordinate.
   * @param float $longitude
   *   The longitude of the coordinate.
   */
  public function __construct(float $latitude = NULL, float $longitude = NULL) {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }

  /**
   * {@inheritdoc}
   */
  public function getLongitude() {
    return $this->longitude ? $this->longitude : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getLatitude() {
    return $this->latitude ? $this->latitude : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function setLongitude($longitude = NULL) {
    $this->longitude = $longitude;
  }

  /**
   * {@inheritdoc}
   */
  public function setLatitude($latitude = NULL) {
    $this->latitude = $latitude;
  }

  /**
   * {@inheritdoc}
   */
  public function getSpatial() {

    // Check for valid coordinates.
    if (!$this->getLatitude() || !$this->getLongitude()) {
      return NULL;
    }

    return $this->getLatitude() . ',' . $this->getLongitude();
  }

}
