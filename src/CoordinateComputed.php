<?php

namespace Drupal\coordinates;

use Drupal\Core\TypedData\DataDefinitionInterface;
use Drupal\Core\TypedData\TypedDataInterface;
use Drupal\Core\TypedData\TypedData;
use Drupal\coordinates\Plugin\Field\FieldType\CoordinateFieldItemInterface;
use InvalidArgumentException;

/**
 * A computed property for coordinate of coordinate field items.
 *
 * Required settings (below the definition's 'settings' key) are:
 *  - latitude: The latitude property.
 *  - longitude: The longitude property.
 */
class CoordinateComputed extends TypedData {

  /**
   * Cached computed coordinate.
   *
   * @var \Drupal\coordinates\CoordinateInterface|null
   */
  protected $coordinate = NULL;

  /**
   * {@inheritdoc}
   */
  public function __construct(DataDefinitionInterface $definition, $name = NULL, TypedDataInterface $parent = NULL) {
    parent::__construct($definition, $name, $parent);

    if (!$this->getParent() instanceof CoordinateFieldItemInterface) {
      throw new InvalidArgumentException("The coordinate computer will only work on an implementation of the CoordinateFieldItemInterface");
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    if ($this->coordinate !== NULL) {
      return $this->coordinate;
    }

    /** @var \Drupal\coordinates\Plugin\Field\FieldType\CoordinateFieldItemInterface $coordinateField */
    $coordinateField = $this->getParent();
    return $coordinateField->toCoordinate();
  }

  /**
   * {@inheritdoc}
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function setValue($value, $notify = TRUE) {
    $this->coordinate = $value;
    // Notify the parent of any changes.
    if (isset($this->parent)) {
      $this->parent->onChange($this->name);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getString() {
    $string = '';
    if ($this->getValue()) {
      $string = $this->getValue()->getLatitude() . ' ' . $this->getValue()->getLongitude();
    }
    return (string) $string;
  }

}
