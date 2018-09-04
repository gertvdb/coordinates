<?php

namespace Drupal\Tests\coordinates\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\coordinates\Coordinate;
use Drupal\coordinates\Formatter\CoordinateFormatter;

/**
 * Class CoordinateFormatterTest.
 *
 * @group coordinates
 */
class CoordinateFormatterTest extends UnitTestCase {

  /**
   * Test the to array function.
   */
  public function testFormat() {
    $latitude = 37.419857;
    $longitude = -122.078827;

    $coodinate = new Coordinate($latitude, $longitude);
    $coodinateFormatter = new CoordinateFormatter();

    $this->assertEquals($coodinateFormatter->format($coodinate, '%lat - %lon'), $latitude . ' - ' . $longitude);
    $this->assertEquals($coodinateFormatter->format($coodinate, 'lat: %lat, lon: %lon'), 'lat: ' . $latitude . ', lon: ' . $longitude);
    $this->assertEquals($coodinateFormatter->format($coodinate, '%lon %lat'), $longitude . ' ' . $latitude);
  }

}
