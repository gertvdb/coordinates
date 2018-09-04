<?php

namespace Drupal\Tests\coordinates\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\coordinates\Coordinate;
use Drupal\coordinates\CoordinateCollection;

/**
 * Class CoordinateCollectionTest.
 *
 * @group coordinates
 */
class CoordinateCollectionTest extends UnitTestCase {

  /**
   * Test the to array function.
   */
  public function testCount() {
    $coordinates = [];
    $coordinates[] = new Coordinate(37.419857, -12.078827);
    $coordinates[] = new Coordinate(32.450023, -122.078827);
    $coordinates[] = new Coordinate(12.900093, 13.953000);
    $coordinates[] = new Coordinate(89.452827, 14.894999);
    $coordinateCollection = new CoordinateCollection($coordinates);

    $this->assertEquals($coordinateCollection->count(), 4);
    $this->assertArrayEquals($coordinateCollection->getCollection(), $coordinates);
  }

  /**
   * Test the to array function.
   */
  public function testAdd() {

    $coordinates = [];
    $coordinates[] = new Coordinate(37.419857, -12.078827);
    $coordinates[] = new Coordinate(32.450023, -122.078827);
    $coordinates[] = new Coordinate(12.900093, 13.953000);
    $coordinates[] = new Coordinate(89.452827, 14.894999);
    $coordinateCollection = new CoordinateCollection($coordinates);

    $addCoordinate = new Coordinate(89.452827, 14.894999);

    $coordinateCollection->add($addCoordinate);
    $this->assertEquals($coordinateCollection->count(), 5);
  }

  /**
   * Test the to array function.
   */
  public function testOverride() {
    $coordinates = [];
    $coordinates[] = new Coordinate(37.419857, -12.078827);
    $coordinates[] = new Coordinate(32.450023, -122.078827);
    $coordinates[] = new Coordinate(12.900093, 13.953000);
    $coordinates[] = new Coordinate(89.452827, 14.894999);
    $coordinateCollection = new CoordinateCollection($coordinates);

    $overrideCoordinate = new Coordinate(89.452827, 14.894999);

    $coordinateCollection->override(4, $overrideCoordinate);
    $this->assertEquals($coordinateCollection->count(), 4);
    $this->assertArrayEquals($coordinateCollection->getCollection(), $coordinates);
  }

}
