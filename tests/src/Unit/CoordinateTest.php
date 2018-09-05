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
   * Test invalid latitude.
   *
   * @expectedException \InvalidArgumentException
   */
  public function testInvalidLatitude() {
    $latitude = 'invalid';
    $longitude = -122.078827;

    new Coordinate($latitude, $longitude);
  }

  /**
   * Test invalid longitude.
   *
   * @expectedException \InvalidArgumentException
   */
  public function testInvalidLongitude() {
    $latitude = 37.419857;
    $longitude = 'invalid';

    new Coordinate($latitude, $longitude);
  }

  /**
   * Test coordinate.
   */
  public function testCoordinate() {
    $latitude = 37.419857;
    $longitude = -122.078827;

    $coordinate = new Coordinate($latitude, $longitude);
    $this->assertInstanceOf('\Drupal\coordinates\Coordinate', $coordinate);
    $this->assertEquals($coordinate->getLatitude(), $latitude);
    $this->assertEquals($coordinate->getLongitude(), $longitude);
  }

}
