<?php

namespace Runalyze\Calculation\Scale;

/**
 * Generated by hand
 */
class PercentalTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var Percental
	 */
	protected $object;

	protected function setUp() {
		$this->object = new Percental();
	}

	protected function tearDown() {
	}

	public function testNoTransformation() {
		$this->assertEquals( 26, $this->object->transform(26) );
	}

	public function testMinMax() {
		$this->assertEquals(   0, $this->object->transform(-10) );
		$this->assertEquals(   0, $this->object->transform(  0) );
		$this->assertEquals( 100, $this->object->transform(100) );
		$this->assertEquals( 100, $this->object->transform(120) );
	}

	public function testNewMinimum() {
		$this->object->setMinimum(-400);

		$this->assertEquals(  40, $this->object->transform(-200) );
		$this->assertEquals(  80, $this->object->transform(   0) );
	}

	public function testNewMaximum() {
		$this->object->setMaximum(200);

		$this->assertEquals(  50, $this->object->transform(100) );
		$this->assertEquals(  75, $this->object->transform(150) );
		$this->assertEquals( 100, $this->object->transform(210) );
	}

	public function testNewScale() {
		$this->object->setMinimum(1);
		$this->object->setMaximum(10);

		$this->assertEquals(   0, $this->object->transform(0.9) );
		$this->assertEquals(   5, $this->object->transform(1.45) );
		$this->assertEquals(  50, $this->object->transform(5.5) );
		$this->assertEquals(  69, $this->object->transform(7.2), '', 0.5 );
		$this->assertEquals(  89, $this->object->transform(9.0), '', 0.5 );
	}
}
