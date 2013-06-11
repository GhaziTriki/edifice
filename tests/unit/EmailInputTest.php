<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LionArt
 * Date: 10/06/13
 * Time: 21:13
 */
require_once 'EdificeTestCase.php';

class EmailInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleEmailInput() {
		$emailSimple        = $this->edifice->email('user_email');
		$emailRequiredStyle = $this->edifice->email('user_email', 'ghazi@github.com', array('class' => 'required', 'required' => 'required'));
		$emailPlaceholder   = $this->edifice->email('user_email', null, array('placeholder' => 'First name'));

		$this->assertEquals('<div class="row"><input name="user_email" type="email"></div>', $emailSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="user_email" type="email" value="ghazi@github.com"></div>', $emailRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="First name" name="user_email" type="email"></div>', $emailPlaceholder);
	}

	public function testEmailWithTopLabel() {
		$emailWithLabelTopLeft  = $this->edifice->email('user_email', null, array('label' => array('text' => 'First name')));
		$emailWithLabelTopRight = $this->edifice->email('user_email', null, array('label' => array('text' => 'First name', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_email">First name</label><input name="user_email" type="email" id="user_email"></div>', $emailWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_email" class="right">First name</label><input name="user_email" type="email" id="user_email"></div>', $emailWithLabelTopRight);
	}

	public function testEmailWithInlineLabel() {
		$emailWithLabelInlineLeft  = $this->edifice->email('user_email', null, array('label' => array('text' => 'First name', 'inline' => true)));
		$emailWithLabelInlineRight = $this->edifice->email('user_email', null, array('label' => array('text' => 'First name', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_email" class="inline">First name</label></div><div class="small-8 large-8 columns"><input name="user_email" type="email" id="user_email"></div></div>', $emailWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_email" class="inline right">First name</label></div><div class="small-8 large-8 columns"><input name="user_email" type="email" id="user_email"></div></div>', $emailWithLabelInlineRight);
	}

	public function testEmailWithPrefix() {
		$emailWithPrefix = $this->edifice->email('user_email', 'github.com', array('prefix' => array('text' => 'domain.')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">domain.</span></div><div class="small-8 large-8 columns"><input name="user_email" type="email" value="github.com"></div></div>', $emailWithPrefix);
	}

	public function testEmailWithPostfix() {
		$emailWithPrefix = $this->edifice->email('user_email', 'ghazi@github.com', array('postfix' => array('text' => '.tn')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="user_email" type="email" value="ghazi@github.com"></div><div class="small-4 large-4 columns"><span class="postfix">.tn</span></div></div>', $emailWithPrefix);
	}
}