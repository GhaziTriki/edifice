<?php

use Illuminate\Support\MessageBag;

require_once 'EdificeTestCase.php';

class TextInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleTextInput() {
		$textSimple        = $this->edifice->text('first_name');
		$textRequiredStyle = $this->edifice->text('first_name', 'Ghazi', array('class' => 'required', 'required' => 'required'));
		$textPlaceholder   = $this->edifice->text('first_name', null, array('placeholder' => 'First name'));

		$this->assertEquals('<div class="row"><input name="first_name" type="text"></div>', $textSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="first_name" type="text" value="Ghazi"></div>', $textRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="First name" name="first_name" type="text"></div>', $textPlaceholder);
	}

	public function testTextWithTopLabel() {
		$textWithLabelTopLeft  = $this->edifice->text('first_name', null, array('label' => array('text' => 'First name')));
		$textWithLabelTopRight = $this->edifice->text('first_name', null, array('label' => array('text' => 'First name', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="first_name">First name</label><input name="first_name" type="text" id="first_name"></div>', $textWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="first_name" class="right">First name</label><input name="first_name" type="text" id="first_name"></div>', $textWithLabelTopRight);
	}

	public function testTextWithInlineLabel() {
		$textWithLabelInlineLeft  = $this->edifice->text('first_name', null, array('label' => array('text' => 'First name', 'inline' => true)));
		$textWithLabelInlineRight = $this->edifice->text('first_name', null, array('label' => array('text' => 'First name', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="first_name" class="inline">First name</label></div><div class="small-8 large-8 columns"><input name="first_name" type="text" id="first_name"></div></div>', $textWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="first_name" class="inline right">First name</label></div><div class="small-8 large-8 columns"><input name="first_name" type="text" id="first_name"></div></div>', $textWithLabelInlineRight);
	}

	public function testTextWithPrefix() {
		$textWithPrefix = $this->edifice->text('site_url', 'github.com', array('prefix' => array('text' => 'http://')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">http://</span></div><div class="small-8 large-8 columns"><input name="site_url" type="text" value="github.com"></div></div>', $textWithPrefix);
	}

	public function testTextWithPostfix() {
		$textWithPrefix = $this->edifice->text('site_url', 'github', array('postfix' => array('text' => '.com')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="site_url" type="text" value="github"></div><div class="small-4 large-4 columns"><span class="postfix">.com</span></div></div>', $textWithPrefix);
	}

	public function testSimpleWithError() {
		$errors = new MessageBag(array('first_name' => array('Incomplete First name')));
		$this->session->set('errors', $errors);

		$textSimple = $this->edifice->text('first_name');
		$this->assertEquals('<div class="row error"><input name="first_name" type="text"><small>Incomplete First name</small></div>', $textSimple);
	}
}