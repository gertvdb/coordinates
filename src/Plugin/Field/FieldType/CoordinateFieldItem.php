<?php

namespace Drupal\coordinates\Plugin\Field\FieldType;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldType;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldItemBase;
use Drupal\coordinates\Coordinate;
use Drupal\coordinates\CoordinateInterface;
use Drupal\Core\TypedData\PrimitiveBase;

/**
 * Plugin implementation of the 'coordinate' field type.
 *
 * @FieldType(
 *   id = "coordinate",
 *   label = @Translation("Coordinate"),
 *   description = @Translation("Create and store coordinate values."),
 *   default_widget = "coordinate_default",
 *   default_formatter = "coordinate_default",
 *   list_class = "\Drupal\coordinates\Plugin\Field\FieldType\CoordinateFieldItemList",
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
      ->setClass('\Drupal\coordinates\CoordinateComputed');

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
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function onChange($propertyName, $notify = TRUE) {

    // Enforce that the computed coordinate is recalculated.
    if (in_array($propertyName, ['latitude', 'longitude'])) {

        try {
            $this->set('value', NULL);
        }
        catch (\Exception $exception) {
            // In theory this will never throw an exception since we define the property.
        }
    }

    parent::onChange($propertyName, $notify);
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    parent::getValue();
    $this->values = $this->toCoordinate();
    return $this->values;
  }

  /**
   * {@inheritdoc}
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function setValue($values, $notify = TRUE) {
    // Allow callers to pass a CoordinateInterface object
    // as the field item value.
    if ($values instanceof CoordinateInterface) {
      $values = $values->toArray();
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

    try {

        /** @var \Drupal\Core\TypedData\PrimitiveBase $latitudeValue */
        $latitudeValue = $this->get('latitude');
        if (!$latitudeValue instanceof PrimitiveBase) {
            return NULL;
        }

        return $latitudeValue->getCastedValue();

    }
    catch (\Exception $exception) {
        return NULL;
    }
  }

  /**
   * Get the longitude.
   *
   * @return float|null
   *   A longitude.
   */
  public function getLongitude() {

    try {

      /** @var \Drupal\Core\TypedData\PrimitiveBase $latitudeValue */
      $longitudeValue = $this->get('longitude');
      if (!$longitudeValue instanceof PrimitiveBase) {
        return NULL;
      }

      return $longitudeValue->getCastedValue();

    }
    catch (\Exception $exception) {
      return NULL;
    }

  }

  /**
   * Get the coordinate object.
   */
  public function toCoordinate() {
    $coordinate = NULL;

    try {

      if (!$this->getLatitude() || !$this->getLongitude()) {
        return NULL;
      }

      return new Coordinate($this->getLatitude(), $this->getLongitude());
    }
    catch (\Exception $e) {
      return NULL;
    }

  }

}
