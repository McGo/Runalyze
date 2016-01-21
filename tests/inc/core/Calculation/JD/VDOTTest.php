<?php

namespace Runalyze\Calculation\JD;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2014-11-29 at 21:09:10.
 */
class VDOTTest extends \PHPUnit_Framework_TestCase {

	protected function setUp() {
		VDOT::setPrecision(2);
		VDOT::setMethod(VDOT::METHOD_LOGARITHMIC);
	}
	protected function tearDown() {
		VDOT::setPrecision(2);
		VDOT::setMethod(VDOT::METHOD_LOGARITHMIC);
	}

	public function testConstructor() {
		$Value = new VDOT(50.1234);

		$this->assertEquals(50.12, $Value->value());
		$this->assertEquals(50.1234, $Value->exactValue());
	}

	public function testWithCorrector() {
		$Value = new VDOT(50, new VDOTCorrector(0.9));

		$this->assertEquals(45, $Value->value());
		$this->assertEquals(50, $Value->uncorrectedValue());

		$Value->setCorrector(new VDOTCorrector(1));
		$this->assertEquals(50, $Value->value());
	}

	public function testMultiplication() {
		$Value = new VDOT(50);
		$Value->multiply(0.9);

		$this->assertEquals(45, $Value->value());
	}

	public function testInvalidResults() {
		$Value = new VDOT();

		$Value->fromPace(1, 0);
		$this->assertEquals(0, $Value->value());

		$Value->fromPace(1, 3600);
		$this->assertEquals(0, $Value->value());
	}

	public function test5kResults() {
		$Value = new VDOT();

		$Results = array(
			30 => 30*60 + 40,
			35 => 27*60 +  0,
			40 => 24*60 +  8,
			45 => 21*60 + 50,
			50 => 19*60 + 57,
			55 => 18*60 + 22,
			60 => 17*60 +  3,
			65 => 15*60 + 54,
			70 => 14*60 + 55,
			75 => 14*60 +  3,
			80 => 13*60 + 18,
			85 => 12*60 + 37
		);

		foreach ($Results as $vdot => $seconds) {
			$Value->fromPace(5, $seconds);
			$this->assertEquals($vdot, $Value->value(), 'VDOT formula failed for 5k, vdot = '.$vdot, 0.1);
		}
	}

	public function test10kResults() {
		$Value = new VDOT();

		$Results = array(
			30 => 63*60 + 46,
			35 => 56*60 +  3,
			40 => 50*60 +  3,
			45 => 45*60 + 16,
			50 => 41*60 + 21,
			55 => 38*60 +  6,
			60 => 35*60 + 22,
			65 => 33*60 +  1,
			70 => 31*60 +  0,
			75 => 29*60 + 14,
			80 => 27*60 + 41,
			85 => 26*60 + 19
		);

		foreach ($Results as $vdot => $seconds) {
			$Value->fromPace(10, $seconds);
			$this->assertEquals($vdot, $Value->value(), 'VDOT formula failed for 10k, vdot = '.$vdot, 0.1);
		}
	}

	public function test21kResults() {
		$Value = new VDOT();

		$Results = array(
			30 => 2*60*60 + 21*60 +  4,
			35 => 2*60*60 +  4*60 + 13,
			40 => 1*60*60 + 50*60 + 59,
			45 => 1*60*60 + 40*60 + 20,
			50 => 1*60*60 + 31*60 + 35,
			55 => 1*60*60 + 24*60 + 18,
			60 => 1*60*60 + 18*60 +  9,
			65 => 1*60*60 + 12*60 + 53,
			70 => 1*60*60 +  8*60 + 21,
			75 => 1*60*60 +  4*60 + 23,
			80 => 1*60*60 +  0*60 + 54,
			85 => 0*60*60 + 57*60 + 50
		);

		foreach ($Results as $vdot => $seconds) {
			$Value->fromPace(21.0975, $seconds);
			$this->assertEquals($vdot, $Value->value(), 'VDOT formula failed for 21.1k, vdot = '.$vdot, 0.1);
		}
	}

	public function test42kResults() {
		$Value = new VDOT();

		$Results = array(
			30 => 4*60*60 + 49*60 + 17,
			35 => 4*60*60 + 16*60 +  3,
			40 => 3*60*60 + 49*60 + 45,
			45 => 3*60*60 + 28*60 + 26,
			50 => 3*60*60 + 10*60 + 49,
			55 => 2*60*60 + 56*60 +  1,
			60 => 2*60*60 + 43*60 + 25,
			65 => 2*60*60 + 32*60 + 35,
			70 => 2*60*60 + 23*60 + 10,
			75 => 2*60*60 + 14*60 + 55,
			80 => 2*60*60 +  7*60 + 38,
			85 => 2*60*60 +  1*60 + 10
		);

		foreach ($Results as $vdot => $seconds) {
			$Value->fromPace(42.195, $seconds);
			$this->assertEquals($vdot, $Value->value(), 'VDOT formula failed for 42.2k, vdot = '.$vdot, 0.1);
		}
	}

	public function testSpeed() {
		// 250 m/min = 4:00 min/km
		// VDOT 48: 3.000m in 11:58
		$Value = new VDOT();
		$Value->fromSpeed(250);

		$this->assertEquals(48, $Value->value(), '', 0.6);
		$this->assertEquals(250, $Value->speed(), '', 0.1);
		$this->assertEquals(240, $Value->pace(), '', 0.1);
		$this->assertEquals(240, $Value->paceAt(1.0), '', 0.1);
	}

	public function testVeryLowSpeed() {
		// 16.67 m/min = ca. 60 min/km
		$Value = new VDOT();
		$Value->fromSpeed(16.67);

		$this->assertEquals(0, $Value->value());
		$this->assertEquals(0, $Value->speed());
		$this->assertEquals(0, $Value->pace());
	}

	public function testDistanceIndependenceOfEstimateByHR() {
		$Value1 = new VDOT();
		$Value1->fromPaceAndHR(10, 40*60 +  0, 0.75);

		$Value2 = new VDOT();
		$Value2->fromPaceAndHR( 3, 12*60 +  0, 0.75);

		$this->assertEquals($Value1->value(), $Value2->value());
	}

	public function testMissingValueForEmptyHR() {
		$Value = new VDOT;
		$Value->fromPaceAndHR(10, 40*60 + 0, 0);

		$this->assertEquals(0, $Value->value());
	}

	/**
	 * @see Jack Daniels' Runnig Formula, german edition, table 2.2, p. 42f.
	 */
	public function testHRformula() {
		$Table = array(
			// % vVDOT => % HRmax
			59 => 65,
			60 => 66,
			61 => 67,
			62 => 68,
			63 => 69,
			64 => 70,
			65 => 71,
			66 => 72,
			67 => 73,
			68 => 74,
			69 => 75,
			70 => 75.5,
			71 => 76,
			72 => 77,
			73 => 78,
			74 => 79,
			75 => 80,
			76 => 81,
			77 => 82,
			78 => 83,
			79 => 84,
			80 => 85,
			81 => 86,
			82 => 87,
			83 => 88,
			84 => 89,
			85 => 89.5,
			86 => 90,
			87 => 91,
			88 => 92,
			89 => 92.5,
			90 => 93,
			91 => 94,
			92 => 95,
			93 => 96,
			94 => 97,
			95 => 97.5,
			96 => 98,
			97 => 98.5,
			98 => 99,
			99 => 99.5,
			100 => 100
		);

		// since v1.5
		$epsilon1 = 1.25;
		VDOT::setMethod(VDOT::METHOD_LOGARITHMIC);
		foreach ($Table as $vVDOT => $HR) {
			$this->assertEquals($HR/100, Vdot::HRat($vVDOT/100), 'VDOT::HRat('.$vVDOT.')[log] failed', $epsilon1/100);
			$this->assertEquals($vVDOT/100, Vdot::percentageAt($HR/100), 'VDOT::percentageAt('.$HR.')[log] failed', $epsilon1/100);
		}

		// up to v1.4
		$epsilon2 = 4;
		VDOT::setMethod(VDOT::METHOD_LINEAR);
		foreach ($Table as $vVDOT => $HR) {
			$this->assertEquals($HR/100, Vdot::HRat($vVDOT/100), 'VDOT::HRat('.$vVDOT.')[lin] failed', $epsilon2/100);
			$this->assertEquals($vVDOT/100, Vdot::percentageAt($HR/100), 'VDOT::percentageAt('.$HR.')[lin] failed', $epsilon2/100);
		}
	}

}
