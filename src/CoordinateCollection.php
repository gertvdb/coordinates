<?php

namespace Drupal\coordinates;

/**
 * CoordinateCollection.
 */
final class CoordinateCollection implements CoordinateCollectionInterface {

  /**
   * The coordinates.
   *
   * @var \Drupal\coordinates\Coordinate[]|array
   */
  protected $coordinates;

  /**
   * Constructor.
   *
   * @param \Drupal\coordinates\Coordinate[]|array $coordinates
   *   An array of coordinates.
   */
  public function __construct(array $coordinates = array()) {
    $this->coordinates = $coordinates;
  }

  /**
   * Add a coordinate.
   *
   * @param CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function add(CoordinateInterface $coordinate) {
    $this->coordinates[] = $coordinate;
  }

  /**
   * Set a coordinate in collection.
   *
   * @param int $key
   *   A numeric key.
   * @param CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function set($key, CoordinateInterface $coordinate) {
    if (isset($this->coordinates[$key])) {
      $this->coordinates[$key] = $coordinate;
    }
  }

  /**
   * Get the coordinates collection.
   *
   * @return \Drupal\coordinates\Coordinate[]
   *   The collection array.
   */
  public function getCollection() {
    return $this->coordinates ? $this->coordinates : [];
  }

  /**
   * Set the coordinates collection.
   *
   * @param \Drupal\coordinates\Coordinate[] $collection
   *   The collection array.
   */
  public function setCollection(array $collection) {
    $this->coordinates = $collection;
  }

}
