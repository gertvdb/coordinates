<?php

namespace Drupal\coordinates\Plugin\Field\FieldType;

use Drupal\coordinates\CoordinateCollectionInterface;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Interface CoordinateFieldItemListInterface.
 *
 * @package Drupal\coordinates\Plugin\Field\FieldType
 */
interface CoordinateFieldItemListInterface extends FieldItemListInterface {

  /**
   * Gets a coordinate collection from field.
   *
   * @return CoordinateCollectionInterface[]
   *   A coordinate collection object.
   */
  public function coordinateCollection();

}
