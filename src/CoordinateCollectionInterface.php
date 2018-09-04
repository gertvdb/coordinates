<?php

namespace Drupal\coordinates;

/**
 * CoordinateCollectionInterface.
 */
interface CoordinateCollectionInterface extends \IteratorAggregate {

  /**
   * Count the collection.
   *
   * @return int
   *   The count of the coordinates in the collection.
   */
  public function count();

  /**
   * Add a coordinate to the collection.
   *
   * @param \Drupal\coordinates\CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function add(CoordinateInterface $coordinate);

  /**
   * Override a coordinate in collection.
   *
   * @param int $key
   *   A numeric key.
   * @param \Drupal\coordinates\CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function override($key, CoordinateInterface $coordinate);

  /**
   * Get the coordinates collection.
   *
   * @return \Drupal\coordinates\CoordinateInterface[]
   *   The collection array.
   */
  public function getCollection();

}
