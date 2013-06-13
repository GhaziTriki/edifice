<?php
/*
 * Copyright (C) 2013 Ghazi Triki <ghazi.nocturne@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'EdificeTestCase.php';

class TextareaInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleTextArea() {
		$textAreaSimple        = $this->edifice->textarea('user_comments');
		$textAreaRequiredStyle = $this->edifice->textarea('user_comments', 'Ghazi', array('class' => 'required', 'required' => 'required'));
		$textAreaPlaceholder   = $this->edifice->textarea('user_comments', null, array('placeholder' => 'User comments'));

		$this->assertEquals('<div class="row"><textarea name="user_comments" cols="50" rows="10"></textarea></div>', $textAreaSimple);
		$this->assertEquals('<div class="row"><textarea class="required" required="required" name="user_comments" cols="50" rows="10">Ghazi</textarea></div>', $textAreaRequiredStyle);
		$this->assertEquals('<div class="row"><textarea placeholder="User comments" name="user_comments" cols="50" rows="10"></textarea></div>', $textAreaPlaceholder);
	}

	public function testTextAreaWithTopLabel() {
		$textAreaWithLabelTopLeft  = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments')));
		$textAreaWithLabelTopRight = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_comments">User comments</label><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div>', $textAreaWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_comments" class="right">User comments</label><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div>', $textAreaWithLabelTopRight);
	}

	public function testTextAreaWithInlineLabel() {
		$textAreaWithLabelInlineLeft  = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments', 'inline' => true)));
		$textAreaWithLabelInlineRight = $this->edifice->textarea('user_comments', null, array('label' => array('text' => 'User comments', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_comments" class="inline">User comments</label></div><div class="small-8 large-8 columns"><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div></div>', $textAreaWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_comments" class="inline right">User comments</label></div><div class="small-8 large-8 columns"><textarea name="user_comments" cols="50" rows="10" id="user_comments"></textarea></div></div>', $textAreaWithLabelInlineRight);
	}

}