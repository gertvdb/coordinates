<?php

namespace Drupal\coordinates_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemListInterface;

/**
 * Interface CoordinateFieldItemListInterface.
 *
 * @package Drupal\coordinates_field\Plugin\Field\FieldType
 */
interface CoordinateFieldItemListInterface extends FieldItemListInterface {

  /**
   * Gets a coordinate collection from field.
   *
   * @return \Drupal\coordinates\CoordinateCollectionInterface[]
   *   A coordinate collection object.
   */
  public function coordinateCollection();

}
