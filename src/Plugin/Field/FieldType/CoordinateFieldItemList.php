<?php

namespace Drupal\coordinates\Plugin\Field\FieldType;

use Drupal\coordinates\CoordinateCollection;
use Drupal\Core\Field\FieldItemList;

/**
 * Represents a configurable entity coordinate field.
 */
class CoordinateFieldItemList extends FieldItemList implements CoordinateFieldItemListInterface {

  /**
   * {@inheritdoc}
   */
  public function coordinateCollection() {
    if (empty($this->list)) {
      return NULL;
    }
    return new CoordinateCollection($this->list);
  }

}
