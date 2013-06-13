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