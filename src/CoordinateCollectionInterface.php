<?php

namespace Drupal\coordinates;

/**
 * CoordinateCollectionInterface.
 */
interface CoordinateCollectionInterface {

  /**
   * Add a coordinate.
   *
   * @param CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function add(CoordinateInterface $coordinate);

  /**
   * Update a coordinate in collection.
   *
   * @param int $key
   *   A numeric key.
   * @param CoordinateInterface $coordinate
   *   A coordinate object.
   */
  public function update($key, CoordinateInterface $coordinate);

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
