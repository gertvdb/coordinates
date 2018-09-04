<?php

declare(strict_types = 1);

namespace Drupal\coordinates;

use Drupal\coordinates\Utility\CoordinateValidator;

/**
 * Coordinate.
 *
 * A coordinate object to store coordinates.
 */
final class Coordinate implements CoordinateInterface {

  /**
   * The latitude.
   *
   * @var double
   */
  protected $latitude;

  /**
   * The longitude.
   *
   * @var double
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
   * @param double $latitude
   *   The latitude of the coordinate.
   * @param double $longitude
   *   The longitude of the coordinate.
   */
  public function __construct(double $latitude, double $longitude) {
    $this->setLatitude($latitude);
    $this->setLongitude($longitude);
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
   * @param double $longitude
   *   The new longitude value.
   */
  public function setLongitude(double $longitude) {

    if (!CoordinateValidator::isValidLongitude($longitude)) {
      throw new \Exception('The provide longitude is invalid.');
    }

    $this->longitude = $longitude;
  }

  /**
   * Set the latitude value.
   *
   * @param double $latitude
   *   The new latitude value.
   */
  public function setLatitude(double $latitude) {

    if (!CoordinateValidator::isValidLatitude($latitude)) {
      throw new \Exception('The provide latitude is invalid.');
    }

    $this->latitude = $latitude;
  }

}
