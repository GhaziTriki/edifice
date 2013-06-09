<?php

require_once 'EdificeTestCase.php';

class FormTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testFormOpen() {
		$this->edifice->open();
	}

	public function testFormClose() {
		$this->assertEquals('</form>', $this->edifice->close());
	}

}