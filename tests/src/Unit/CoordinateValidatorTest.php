<?php

namespace Drupal\Tests\coordinates\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\coordinates\Utility\CoordinateValidator;

/**
 * Class CoordinateValidatorTest.
 *
 * @group coordinates
 */
class CoordinateValidatorTest extends UnitTestCase {

  /**
   * Test a valid latitude.
   */
  public function testValidLatitude() {
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(37.419857));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(12.00));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(-2.148888888));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(-45.90900034));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(67.912238494404440));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(0));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLatitude(19));
  }

  /**
   * Test a invalid latitude.
   */
  public function testInvalidLatitude() {
    $this->assertEquals(FALSE, CoordinateValidator::isValidLatitude('INVALID'));
    $this->assertEquals(FALSE, CoordinateValidator::isValidLatitude(-190000.369699));
    $this->assertEquals(FALSE, CoordinateValidator::isValidLatitude(23400000));
  }

  /**
   * Test a valid longitude.
   */
  public function testValidLongitude() {
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(37.419857));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(12.00));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(-2.148888888));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(-45.90900034));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(67.912238494404440));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(0));
    $this->assertEquals(TRUE, CoordinateValidator::isValidLongitude(19));
  }

  /**
   * Test an invalid longitude.
   */
  public function testInvalidLongitude() {
    $this->assertEquals(FALSE, CoordinateValidator::isValidLongitude('INVALID'));
    $this->assertEquals(FALSE, CoordinateValidator::isValidLongitude(-190000.369699));
    $this->assertEquals(FALSE, CoordinateValidator::isValidLongitude(23400000));

  }

}
