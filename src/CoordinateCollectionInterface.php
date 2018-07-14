<?php

namespace Drupal\coordinates;

/**
 * CoordinateCollectionInterface.
 */
interface CoordinateCollectionInterface {

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
   * @param CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function add(CoordinateInterface $coordinate);

  /**
   * Override a coordinate in collection.
   *
   * @param int $key
   *   A numeric key.
   * @param CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function override($key, CoordinateInterface $coordinate);

  /**
   * Get the coordinates collection.
   *
   * @return \Drupal\coordinates\Coordinate[]
   *   The collection array.
   */
  public function getCollection();

  /**
   * Set the coordinates collection.
   *
   * @param \Drupal\coordinates\Coordinate[] $collection
   *   The collection array.
   */
  public function setCollection(array $collection);

}
