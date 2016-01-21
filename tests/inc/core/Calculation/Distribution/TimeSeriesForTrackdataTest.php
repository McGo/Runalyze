<?php

namespace Runalyze\Calculation\Distribution;

use Runalyze\Model\Trackdata;

/**
 * Generated by hand
 */
class TimeSeriesForTrackdataTest extends \PHPUnit_Framework_TestCase {

	public function testSimpleArray() {
		$Dist = new TimeSeriesForTrackdata(
			new Trackdata\Entity(array(
				Trackdata\Entity::TIME => array(30, 60, 90, 120, 150, 180, 210, 240, 270, 300),
				Trackdata\Entity::HEARTRATE => array(120, 120, 150, 150, 150, 180, 150, 180, 150, 120),
				Trackdata\Entity::DISTANCE => array(0.1, 0.2, 0.35, 0.50, 0.65, 0.85, 1.0, 1.2, 1.35, 1.45),
				Trackdata\Entity::CADENCE => array(80, 84, 85, 90, 95, 100, 95, 100, 95, 85),
				Trackdata\Entity::GROUNDCONTACT => array(200, 185, 170, 160, 150, 120, 200, 120, 200, 200),
			)),
			Trackdata\Entity::HEARTRATE,
			array(Trackdata\Entity::DISTANCE),
			array(Trackdata\Entity::CADENCE, Trackdata\Entity::GROUNDCONTACT)
		);

		$this->assertEquals( array(
			120 => 90,
			150 => 150,
			180 => 60
		), $Dist->histogram() );

		$this->assertEquals( array(
			120 => array(
				Trackdata\Entity::DISTANCE => 0.3,
				Trackdata\Entity::CADENCE => 83,
				Trackdata\Entity::GROUNDCONTACT => 195
			),
			150 => array(
				Trackdata\Entity::DISTANCE => 0.75,
				Trackdata\Entity::CADENCE => 92,
				Trackdata\Entity::GROUNDCONTACT => 176
			),
			180 => array(
				Trackdata\Entity::DISTANCE => 0.4,
				Trackdata\Entity::CADENCE => 100,
				Trackdata\Entity::GROUNDCONTACT => 120
			)
		), $Dist->data() );
	}

}
