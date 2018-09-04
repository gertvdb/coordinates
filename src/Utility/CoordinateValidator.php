<?php

namespace Drupal\coordinates\Utility;

/**
 * Class CoordinateValidator.
 *
 * @package Drupal\coordinates\Utility
 */
class CoordinateValidator {

  /**
   * Validate latitude.
   *
   * @param mixed $latitude
   *   The coordinate object for the first point.
   *
   * @return bool
   *   A boolean indicating if it's a valid latitude.
   */
  public static function isValidLatitude($latitude) {

    // Check whether value passed is numeric.
    if (!is_numeric($latitude)) {
      return FALSE;
    }

    // Check whether value passed is double.
    if (!is_float($latitude)) {
      return FALSE;
    }

    // Check whether value passed is valid latitude.
    return preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,13})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,13})?))$/', $latitude);
  }

  /**
   * Validate longitude.
   *
   * @param mixed $longitude
   *   The longitude.
   *
   * @return bool
   *   A boolean indicating if it's a valid longitude.
   */
  public static function isValidLongitude($longitude) {

    // Check whether value passed is numeric.
    if (!is_numeric($longitude)) {
      return FALSE;
    }

    // Check whether value passed is double.
    if (!is_float($longitude)) {
      return FALSE;
    }

    // Check whether value passed is valid latitude.
    return preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,13})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,13})?))$/', $longitude);
  }

}
