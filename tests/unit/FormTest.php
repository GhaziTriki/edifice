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
		$form1 = $this->edifice->open(array('method' => 'GET'));

		$this->assertEquals('<form method="GET" action="http://localhost/edifice" accept-charset="UTF-8">', $form1);;
	}

	public function testFormClose() {
		$this->assertEquals('</form>', $this->edifice->close());
	}

}