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

class NumberInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleTextInput() {
		$numberSimple        = $this->edifice->number('user_age');
		$numberRequiredStyle = $this->edifice->number('user_age', 28, array('class' => 'required', 'required' => 'required'));
		$numberPlaceholder   = $this->edifice->number('user_age', null, array('placeholder' => 'User age'));

		$this->assertEquals('<div class="row"><input name="user_age" type="number"></div>', $numberSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="user_age" type="number" value="28"></div>', $numberRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="User age" name="user_age" type="number"></div>', $numberPlaceholder);
	}

	public function testTextWithTopLabel() {
		$numberWithLabelTopLeft  = $this->edifice->number('user_age', null, array('label' => array('text' => 'User age')));
		$numberWithLabelTopRight = $this->edifice->number('user_age', null, array('label' => array('text' => 'User age', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_age">User age</label><input name="user_age" type="number" id="user_age"></div>', $numberWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_age" class="right">User age</label><input name="user_age" type="number" id="user_age"></div>', $numberWithLabelTopRight);
	}

	public function testTextWithInlineLabel() {
		$numberWithLabelInlineLeft  = $this->edifice->number('user_age', null, array('label' => array('text' => 'User age', 'inline' => true)));
		$numberWithLabelInlineRight = $this->edifice->number('user_age', null, array('label' => array('text' => 'User age', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_age" class="inline">User age</label></div><div class="small-8 large-8 columns"><input name="user_age" type="number" id="user_age"></div></div>', $numberWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_age" class="inline right">User age</label></div><div class="small-8 large-8 columns"><input name="user_age" type="number" id="user_age"></div></div>', $numberWithLabelInlineRight);
	}

	public function testTextWithPrefix() {
		$numberWithPrefix = $this->edifice->number('user_age', 28, array('prefix' => array('text' => 'Since')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">Since</span></div><div class="small-8 large-8 columns"><input name="user_age" type="number" value="28"></div></div>', $numberWithPrefix);
	}

	public function testTextWithPostfix() {
		$numberWithPrefix = $this->edifice->number('user_age', 28, array('postfix' => array('text' => 'years')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="user_age" type="number" value="28"></div><div class="small-4 large-4 columns"><span class="postfix">years</span></div></div>', $numberWithPrefix);
	}

	public function testSimpleWithError() {
		$this->putErrorInSession(array('user_age' => array('Incomplete User age')));

		$numberSimple = $this->edifice->number('user_age');
		$this->assertEquals('<div class="row error"><input name="user_age" type="number"><small>Incomplete User age</small></div>', $numberSimple);
	}
}