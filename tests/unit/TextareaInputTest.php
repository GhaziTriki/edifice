<?php

require_once 'EdificeTestCase.php';

class TextareaInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleText() {
		$textSimple        = $this->edifice->textarea('user_comments');
		$textRequiredStyle = $this->edifice->textarea('user_comments', 'Ghazi', array('class' => 'required', 'required' => 'required'));
		$textPlaceholder   = $this->edifice->textarea('user_comments', null, array('placeholder' => 'User comments'));

		$this->assertEquals('<div class="row"><textarea name="user_comments" cols="50" rows="10"></textarea></div>', $textSimple);
		$this->assertEquals('<div class="row"><textarea class="required" required="required" name="user_comments" cols="50" rows="10">Ghazi</textarea></div>', $textRequiredStyle);
		$this->assertEquals('<div class="row"><textarea placeholder="User comments" name="user_comments" cols="50" rows="10"></textarea></div>', $textPlaceholder);
	}

	public function testTextWithTopLabel() {
		$textWithLabelTopLeft  = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments')));
		$textWithLabelTopRight = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_comments">User comments</label><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div>', $textWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_comments" class="right">User comments</label><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div>', $textWithLabelTopRight);
	}

	public function testTextWithInlineLabel() {
		$textWithLabelInlineLeft  = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments', 'inline' => true)));
		$textWithLabelInlineRight = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_comments" class="inline">User comments</label></div><div class="small-8 large-8 columns"><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div></div>', $textWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_comments" class="inline right">User comments</label></div><div class="small-8 large-8 columns"><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div></div>', $textWithLabelInlineRight);
	}

}