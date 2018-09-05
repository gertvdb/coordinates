<?php

namespace Drupal\coordinates;

use Drupal\coordinates\Utility\CoordinateValidator;

/**
 * Coordinate.
 *
 * A coordinate object to store coordinates.
 */
class Coordinate implements CoordinateInterface {

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
   * Constructor.
   *
   * @param float $latitude
   *   The latitude of the coordinate.
   * @param float $longitude
   *   The longitude of the coordinate.
   */
  public function __construct($latitude, $longitude) {
    $this->setLatitude($latitude);
    $this->setLongitude($longitude);
  }

  /**
   * {@inheritdoc}
   */
  public function getLongitude() {
    return $this->longitude;
  }

  /**
   * {@inheritdoc}
   */
  public function getLatitude() {
    return $this->latitude;
  }

  /**
   * {@inheritdoc}
   */
  public function toSpatial() {
    return $this->getLatitude() . ',' . $this->getLongitude();
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return [
      'latitude' => $this->getLatitude(),
      'longitude' => $this->getLongitude(),
    ];
  }

  /**
   * Set the longitude value.
   *
   * @param float $longitude
   *   The new longitude value.
   */
  private function setLongitude($longitude) {

    if (!CoordinateValidator::isValidLongitude($longitude)) {
      throw new \InvalidArgumentException('The provide longitude is invalid.');
    }

    $this->longitude = $longitude;
  }

  /**
   * Set the latitude value.
   *
   * @param float $latitude
   *   The new latitude value.
   */
  private function setLatitude($latitude) {

    if (!CoordinateValidator::isValidLatitude($latitude)) {
      throw new \InvalidArgumentException('The provide latitude is invalid.');
    }

    $this->latitude = $latitude;
  }

}
