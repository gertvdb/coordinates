<?php

namespace Drupal\coordinates;

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
    $this->coordinates = $coordinates;
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
    return $this->coordinates ? $this->coordinates : [];
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator($this->coordinates);
  }

}
