<?php

namespace Runalyze\Calculation\Activity;

use Runalyze\Model;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2014-12-31 at 14:09:38.
 */
class CalculatorTest extends \PHPUnit_Framework_TestCase {

	public function testGeneralFunctionality() {
		$Calculator = new Calculator(new Model\Activity\Entity(array(
			Model\Activity\Entity::DISTANCE => 10,
			Model\Activity\Entity::TIME_IN_SECONDS => 3000,
			Model\Activity\Entity::HR_AVG => 150
		), null, null));

		$this->assertGreaterThan(0, $Calculator->calculateVDOTbyTime());
		$this->assertGreaterThan(0, $Calculator->calculateVDOTbyHeartRate());
		$this->assertGreaterThan(0, $Calculator->calculateVDOTbyHeartRateWithElevation());
		$this->assertGreaterThan(0, $Calculator->calculateJDintensity());
		$this->assertGreaterThan(0, $Calculator->calculateTrimp());

		$this->assertGreaterThan($Calculator->calculateVDOTbyTime(), $Calculator->calculateVDOTbyHeartRate());
	}

	public function testEmptyValues() {
		$Calculator = new Calculator(new Model\Activity\Entity(), null, null);

		$this->assertEquals(0, $Calculator->calculateVDOTbyTime());
		$this->assertEquals(0, $Calculator->calculateVDOTbyHeartRate());
		$this->assertEquals(0, $Calculator->calculateVDOTbyHeartRateWithElevation());
		$this->assertEquals(0, $Calculator->calculateJDintensity());
		$this->assertEquals(0, $Calculator->calculateTrimp());
	}

	public function testCalculationsWithElevation() {
		$Activity = new Model\Activity\Entity(array(
			Model\Activity\Entity::DISTANCE => 10,
			Model\Activity\Entity::TIME_IN_SECONDS => 3000,
			Model\Activity\Entity::HR_AVG => 150,
			Model\Activity\Entity::ELEVATION => 100
		));

		$CalculatorOnlyActivity = new Calculator($Activity, null, null);
		$CalculatorOnlyElevation = new Calculator($Activity, null, new Model\Route\Entity(array(
			Model\Route\Entity::ELEVATION => 500
		)));
		$CalculatorUpAndDown = new Calculator($Activity, null, new Model\Route\Entity(array(
			Model\Route\Entity::ELEVATION_UP => 500,
			Model\Route\Entity::ELEVATION_DOWN => 100
		)));
		$CalculatorOnlyDown = new Calculator($Activity, null, new Model\Route\Entity(array(
			Model\Route\Entity::ELEVATION => 500,
			Model\Route\Entity::ELEVATION_UP => 0,
			Model\Route\Entity::ELEVATION_DOWN => 500
		)));

		$this->assertGreaterThan(
			$CalculatorOnlyElevation->calculateVDOTbyHeartRateWithElevation(),
			$CalculatorUpAndDown->calculateVDOTbyHeartRateWithElevation()
		);
		$this->assertGreaterThan(
			$CalculatorOnlyDown->calculateVDOTbyHeartRateWithElevation(),
			$CalculatorOnlyElevation->calculateVDOTbyHeartRateWithElevation()
		);
		$this->assertGreaterThan(
			$CalculatorOnlyActivity->calculateVDOTbyHeartRateWithElevation(),
			$CalculatorOnlyElevation->calculateVDOTbyHeartRateWithElevation()
		);
		$this->assertGreaterThan(
			$CalculatorOnlyActivity->calculateVDOTbyHeartRate(),
			$CalculatorOnlyActivity->calculateVDOTbyHeartRateWithElevation()
		);

		$this->assertEquals(
			$CalculatorUpAndDown->calculateVDOTbyHeartRateWithElevationFor(500, 100),
			$CalculatorUpAndDown->calculateVDOTbyHeartRateWithElevation()
		);
		$this->assertEquals(
			$CalculatorOnlyElevation->calculateVDOTbyHeartRateWithElevationFor(500, 500),
			$CalculatorOnlyElevation->calculateVDOTbyHeartRateWithElevation()
		);
		$this->assertEquals(
			$CalculatorOnlyActivity->calculateVDOTbyHeartRateWithElevationFor(100, 100),
			$CalculatorOnlyActivity->calculateVDOTbyHeartRateWithElevation()
		);
	}

	public function testCalculationsWithTrackdata() {
		$Activity = new Model\Activity\Entity(array(
			Model\Activity\Entity::DISTANCE => 10,
			Model\Activity\Entity::TIME_IN_SECONDS => 3000,
			Model\Activity\Entity::HR_AVG => 150
		));

		$CalculatorOnlyActivity = new Calculator($Activity, null, null);
		$CalculatorWithTrackdata = new Calculator($Activity, new Model\Trackdata\Entity(array(
			Model\Trackdata\Entity::TIME => array(1500, 3000),
			Model\Trackdata\Entity::HEARTRATE => array(125, 175)
		)), null);

		$this->assertGreaterThan($CalculatorOnlyActivity->calculateTrimp(), $CalculatorWithTrackdata->calculateTrimp());
		$this->assertGreaterThan($CalculatorOnlyActivity->calculateJDintensity(), $CalculatorWithTrackdata->calculateJDintensity());
	}

	public function testCalculationWithEmptyHeartrateArray() {
		$Activity = new Model\Activity\Entity(array(
			Model\Activity\Entity::DISTANCE => 10,
			Model\Activity\Entity::TIME_IN_SECONDS => 3000,
			Model\Activity\Entity::HR_AVG => 150
		));

		$CalculatorOnlyActivity = new Calculator($Activity, null, null);
		$CalculatorWithTrackdata = new Calculator($Activity, new Model\Trackdata\Entity(array(
			Model\Trackdata\Entity::TIME => array(1500, 3000),
			Model\Trackdata\Entity::HEARTRATE => array(0, 0)
		)), null);

		$this->assertEquals($CalculatorOnlyActivity->calculateTrimp(), $CalculatorWithTrackdata->calculateTrimp());
	}

}
