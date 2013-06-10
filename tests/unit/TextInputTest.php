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
		$textSimple            = $this->edifice->text('first_name');
		$textRequiredStyle     = $this->edifice->text('first_name', 'Ghazi', array('class' => 'required', 'required' => 'required'));
		$textPlaceholder       = $this->edifice->text('first_name', null, array('placeholder' => 'First name'));
		$textWithLabelTopLeft  = $this->edifice->text('first_name', null, array('label' => array('text' => 'First name')));
		$textWithLabelTopRight = $this->edifice->text('first_name', null, array('label' => array('text' => 'First name', 'align' => 'right')));

		$this->assertEquals('<div class="row"><input name="first_name" type="text"></div>', $textSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="first_name" type="text" value="Ghazi"></div>', $textRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="First name" name="first_name" type="text"></div>', $textPlaceholder);
		$this->assertEquals('<div class="row"><label for="first_name">First name</label><input name="first_name" type="text" id="first_name"></div>', $textWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="first_name" class="right">First name</label><input name="first_name" type="text" id="first_name"></div>', $textWithLabelTopRight);
	}

}