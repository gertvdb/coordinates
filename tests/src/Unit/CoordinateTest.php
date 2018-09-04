<?php

namespace Drupal\Tests\coordinates\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\coordinates\Coordinate;

/**
 * Class CoordinateTest.
 *
 * @group coordinates
 */
class CoordinateTest extends UnitTestCase {

  /**
   * Test the to array function.
   */
  public function testToArray() {
    $latitude = 37.419857;
    $longitude = -122.078827;

    $coodinate = new Coordinate($latitude, $longitude);
    $this->assertEquals($coodinate->toArray(), ['latitude' => $coodinate->getLatitude(), 'longitude' => $coodinate->getLongitude()]);
  }

  /**
   * Test the to spatial function.
   */
  public function testToSpatial() {
    $latitude = 37.419857;
    $longitude = -122.078827;

    $coodinate = new Coordinate($latitude, $longitude);
    $this->assertEquals($coodinate->toSpatial(), $latitude . ',' . $longitude);
  }

  /**
   * Test the to spatial function.
   */
  public function testChangeLatitude() {
    $latitude = 37.419857;
    $longitude = -122.078827;

    $this->assertEquals($coodinate->toSpatial(), $latitude . ',' . $longitude);
  }

}
