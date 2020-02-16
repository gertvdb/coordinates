<?php

namespace Drupal\coordinates;

use ArrayIterator;

/**
 * CoordinateCollection.
 */
final class CoordinateCollection implements CoordinateCollectionInterface {

  /**
   * The coordinates.
   *
   * @var \Drupal\coordinates\CoordinateInterface[]|array
   */
  protected $coordinates;

  /**
   * Constructor.
   *
   * @param \Drupal\coordinates\CoordinateInterface[]|array $coordinates
   *   An array of coordinates.
   */
  public function __construct(array $coordinates = []) {
    $this->coordinates = $this->prepareCollection($coordinates);
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return count($this->coordinates);
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
  public function override($key, CoordinateInterface $coordinate) {
    if (isset($this->coordinates[$key])) {
      $this->coordinates[$key] = $coordinate;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCollection() {
    return $this->coordinates;
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new ArrayIterator($this->coordinates);
  }

  /**
   * Filter out all items that aren't valid coordinates.
   *
   * @param array $coordinates
   *   A array of coordinates.
   *
   * @return array
   *   A filtered array of coordinates.
   */
  protected function prepareCollection(array $coordinates = []) {
    $preparedCollection = [];
    foreach ($coordinates as $coordinate) {
      if ($coordinate instanceof CoordinateInterface) {
        $preparedCollection[] = $coordinate;
      }
    }
    return $preparedCollection;
  }

}
