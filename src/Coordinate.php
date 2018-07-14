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
   * @var float
   */
  protected $latitude;

  /**
   * The longitude.
   *
   * @var float
   */
  protected $longitude;

  /**
   * The latitude and longitude for spatial searches.
   *
   * @var string
   */
  private $spatial;

  /**
   * Constructor.
   *
   * @param float $latitude
   *   The latitude of the coordinate.
   * @param float $longitude
   *   The longitude of the coordinate.
   */
  public function __construct(float $latitude, float $longitude) {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->spatial = $this->getSpatial();
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
  public function getSpatial() {
    return $this->getLatitude() . ',' . $this->getLongitude();
  }

  /**
   * Set the longitude value.
   *
   * @param float $longitude
   *   The new longitude value.
   */
  public function setLongitude(float $longitude) {
    $this->longitude = $longitude;
  }

  /**
   * Set the latitude value.
   *
   * @param float $latitude
   *   The new latitude value.
   */
  public function setLatitude(float $latitude) {
    $this->latitude = $latitude;
  }

}
