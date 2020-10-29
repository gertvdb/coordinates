<?php

namespace Drupal\coordinates\Plugin\Field\FieldType;

use Drupal\coordinates\Service\ProximityCalculationService;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldItemBase;
use Drupal\coordinates\Coordinate;
use Drupal\coordinates\CoordinateInterface;
use Drupal\Core\TypedData\Exception\MissingDataException;
use Drupal\Core\TypedData\Exception\ReadOnlyException;
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
   * Get the proximity calculation service.
   *
   * Since at this point Dependency Injection is not provided for
   * Typed Data (https://www.drupal.org/project/drupal/issues/2914419),
   * we use the Drupal service container in a seperate function so this can be
   * reworked later on when issue is resolved.
   *
   * @return ProximityCalculationService
   *   The proximity calculation service.
   */
  protected function getProximityCalculationSerice() {
    return \Drupal::service('coordinates.proximity_calculations');
  }

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

    // Extra fields for proximity queries.
    $properties['latitude_sin'] = DataDefinition::create('float')
      ->setLabel(t('Latitude sine'))
      ->setComputed(TRUE);

    $properties['latitude_cos'] = DataDefinition::create('float')
      ->setLabel(t('Latitude cosine'))
      ->setComputed(TRUE);

    $properties['longitude_rad'] = DataDefinition::create('float')
      ->setLabel(t('Longitude radian'))
      ->setComputed(TRUE);

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
        'latitude_sin' => [
          'description' => 'Stores the sine of latitude',
          'type' => 'float',
          'size' => 'big',
          'not null' => TRUE,
        ],
        'latitude_cos' => [
          'description' => 'Stores the cosine of latitude',
          'type' => 'float',
          'size' => 'big',
          'not null' => TRUE,
        ],
        'longitude_rad' => [
          'description' => 'Stores the radian longitude',
          'type' => 'float',
          'size' => 'big',
          'not null' => TRUE,
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
        // In theory this will never throw an exception since we define
        // the property.
      }
    }

    parent::onChange($propertyName, $notify);

    if (!$this->isEmpty()) {
        try {
            $this->recalculateProximityFields();
        } catch (MissingDataException $e) {
        } catch (ReadOnlyException $e) {
        }
    }
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
     * @throws MissingDataException
     */
  public function setValue($values, $notify = TRUE) {
    // Allow callers to pass a CoordinateInterface object
    // as the field item value.
    if ($values instanceof CoordinateInterface) {
      $values = $values->toArray();
    }

    parent::setValue($values);

    if (!$this->isEmpty()) {
      $this->recalculateProximityFields();
    }
  }

  /**
   * Recalculate proximity fields.
   *
   * @throws MissingDataException
   * @throws ReadOnlyException
   */
  private function recalculateProximityFields() {
    $service = $this->getProximityCalculationSerice();

    $this->get('latitude_sin')->setValue($service->calcLatitudeSinus($this->getLatitude()), FALSE);
    $this->get('latitude_cos')->setValue($service->calcLatitudeCosinus($this->getLatitude()), FALSE);
    $this->get('longitude_rad')->setValue($service->calcLongitudeRadius($this->getLongitude()), FALSE);
  }

  /**
   * Get the latitude.
   *
   * @return float|null
   *   A latitude.
   */
  public function getLatitude() {

    try {

      /** @var PrimitiveBase $latitudeValue */
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

      /** @var PrimitiveBase $latitudeValue */
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
