<?php

namespace Drupal\coordinates\Utility;

use Drupal\coordinates\CoordinateInterface;
use Drupal\coordinates\CoordinateCollectionInterface;
use Drupal\distance\Distance;

/**
 * Class Distance.
 *
 * @package Drupal\coordinates\Utility
 */
class CoordinateCalculator {

  const RADIUS = M_PI / 180;

  /**
   * Get distance between 2 coordinate objects.
   *
   * @param \Drupal\coordinates\CoordinateInterface|null $coordinate_1
   *   The coordinate object for the first point.
   * @param \Drupal\coordinates\CoordinateInterface|null $coordinate_2
   *   The coordinate object for the second point.
   *
   * @return \Drupal\distance\Distance
   *   A distance object.
   */
  public static function calculateCoordinateDistance(CoordinateInterface $coordinate_1 = NULL, CoordinateInterface $coordinate_2 = NULL) {

    // Get theta for calculations.
    $theta = $coordinate_1->getLongitude() - $coordinate_2->getLongitude();

    // Calculate the distance in degrees.
    $distance_in_degrees = sin($coordinate_1->getLatitude() * self::RADIUS) * sin($coordinate_2->getLatitude() * self::RADIUS) + cos($coordinate_1->getLatitude() * self::RADIUS) * cos($coordinate_2->getLatitude() * self::RADIUS) * cos($theta * self::RADIUS);

    // Convert the distance to miles.
    $distance_in_miles = acos($distance_in_degrees) / self::RADIUS * 60;

    // Return a distance object initiated in miles.
    return new Distance($distance_in_miles, 'MI');
  }

  /**
   * Get distance between coordinates in a coordinate collection.
   *
   * @param \Drupal\coordinates\CoordinateCollectionInterface|null $coordinate_collection
   *   The coordinate collection object.
   */
  public static function calculateCoordinateCollectionDistance(CoordinateCollectionInterface $coordinate_collection = NULL) {

    // Prepare an array of distances.
    $distances = [];

    // Make sure we have a coordinate collection with at least 2 coordinates.
    if ($coordinate_collection && $coordinate_collection->count() >= 2) {

      // Iterate over the coordinates in coordinate collection.
      $coordinate_1 = NULL;
      foreach ($coordinate_collection->getIterator() as $coordinate) {

        // Since we need 2 coordinates at least bypass the loop
        // and assign the first item to $coordinate_1.
        if (!$coordinate_1) {
          $coordinate_1 = $coordinate;
          continue;
        }

        // This will only be executed from the second time the loop runs.
        // We assign the current coordinate to $coordinate_2.
        $coordinate_2 = $coordinate;

        // Calculate the distance and push to array.
        $distances[] = self::calculateCoordinateDistance($coordinate_1, $coordinate_2);
        $coordinate_1 = $coordinate_2;
      }

    }

    return $distances;
  }

}
