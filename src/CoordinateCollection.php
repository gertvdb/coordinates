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
   * {@inheritdoc}
   */
  public function add(CoordinateInterface $coordinate) {
    $this->coordinates[] = $coordinate;
  }

  /**
   * {@inheritdoc}
   */
  public function set($key, CoordinateInterface $coordinate) {
    if (isset($this->coordinates[$key])) {
      $this->coordinates[$key] = $coordinate;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCollection() {
    return $this->coordinates ? $this->coordinates : [];
  }

  /**
   * {@inheritdoc}
   */
  public function setCollection(array $collection) {
    $this->coordinates = $collection;
  }

}
