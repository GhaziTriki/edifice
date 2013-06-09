<?php

require_once 'EdificeTestCase.php';

class TextInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleText() {
		$textSimple        = $this->edifice->text('first_name');
		$textRequiredStyle = $this->edifice->text('first_name', 'Ghazi', array('class' => 'required', 'required' => 'required'));

		$this->assertEquals('<div class="row"><input name="first_name" type="text"></div>', $textSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="first_name" type="text" value="Ghazi"></div>', $textRequiredStyle);

	}

}