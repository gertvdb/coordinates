<?php

namespace Drupal\coordinate\Factory;

use Drupal\coordinates\Coordinate;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines an factory for creating a coordinate.
 *
 * @TODO: Create coordinate from address, ... .
 */
class CoordinateFactory implements ContainerInjectionInterface {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static();
  }

  /**
   * {@inheritdoc}
   */
  public function createCoordinate(float $latitude, float $longitude) {
    try {
      return new Coordinate(
        $latitude,
        $longitude
      );
    }
    catch (\Exception $e) {
      return NULL;
    }
  }

}
