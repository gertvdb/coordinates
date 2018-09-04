<?php

namespace Drupal\coordinates_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldItemBase;
use Drupal\coordinates\Coordinate;
use Drupal\coordinates\CoordinateInterface;

/**
 * Plugin implementation of the 'coordinate' field type.
 *
 * @FieldType(
 *   id = "coordinate",
 *   label = @Translation("Coordinate"),
 *   description = @Translation("Create and store coordinate values."),
 *   default_widget = "coordinate_default",
 *   default_formatter = "coordinate_default",
 *   list_class = "\Drupal\coordinates_field\Plugin\Field\FieldType\CoordinateFieldItemList",
 * )
 */
class CoordinateFieldItem extends FieldItemBase implements CoordinateFieldItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $fieldDefinition) {
    $properties['value'] = DataDefinition::create('any')
      ->setLabel(t('Computed coordinate'))
      ->setDescription(t('The computed Coordinate object.'))
      ->setComputed(TRUE)
      ->setClass('\Drupal\coordinates_field\CoordinateComputed');

    $properties['latitude'] = DataDefinition::create('float')
      ->setLabel(t('Latitude'))
      ->setRequired(TRUE);

    $properties['longitude'] = DataDefinition::create('float')
      ->setLabel(t('Longitude'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $fieldDefinition) {
    return [
      'columns' => [
        'latitude' => [
          'description' => 'Stores the latitude value',
          'type' => 'float',
          'size' => 'big',
          'not null' => FALSE,
        ],
        'longitude' => [
          'description' => 'Stores the longitude value',
          'type' => 'float',
          'size' => 'big',
          'not null' => FALSE,
        ],
      ],
      'indexes' => [
        'coordinate' => [
          'latitude',
          'longitude',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    return !($this->getLatitude() && $this->getLongitude());
  }

  /**
   * {@inheritdoc}
   */
  public function onChange($propertyName) {
    // Enforce that the computed coordinate is recalculated.
    if (in_array($propertyName, ['latitude', 'longitude'])) {
      $this->value = NULL;
    }
    parent::onChange($propertyName);
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    parent::getValue();
    try {
      if ($this->getLatitude() && $this->getLongitude()) {
        $values = new Coordinate($this->getLatitude(), $this->getLongitude());
        $this->values = $values->toArray();
      }
    }
    catch (\Exception $e) {
      $this->values = NULL;
    }
    return $this->values;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($values) {
    // Allow callers to pass a CoordinateInterface object
    // as the field item value.
    if ($values instanceof CoordinateInterface) {
      $coordinate = $values;
      $values = [
        'latitude' => $coordinate->getLatitude(),
        'longitude' => $coordinate->getLongitude(),
      ];
    }

    parent::setValue($values);
  }

  /**
   * Get the latitude.
   *
   * @return float|null
   *   A latitude.
   */
  public function getLatitude() {
    return $this->latitude ? (float) $this->latitude : NULL;
  }

  /**
   * Get the longitude.
   *
   * @return float|null
   *   A longitude.
   */
  public function getLongitude() {
    return $this->longitude ? (float) $this->longitude : NULL;
  }

}
