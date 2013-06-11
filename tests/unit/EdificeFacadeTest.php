<?php

require_once 'EdificeTestCase.php';

class EdificeFacadeAccessorTest extends \EdificeTestCase {

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testGetFacadeAccessor() {
		$class             = new ReflectionClass('Lionart\Edifice\Support\Facades\Edifice');
		$getFacadeAccessor = $class->getMethod('getFacadeAccessor');
		$getFacadeAccessor->setAccessible(true);
		$this->assertEquals('edifice.form', $getFacadeAccessor->invoke('Edifice'));
	}

	public function testProvides() {
		$this->assertEquals(array('edifice.form'), $this->edificeServiceProvider->provides());
	}

}