<?php

declare(strict_types = 1);

namespace Drupal\coordinates_field\Plugin\Field\FieldType;

use Drupal\coordinates\CoordinateCollection;
use Drupal\coordinates_field\Plugin\Field\FieldType\CoordinateFieldItemListInterface;
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
