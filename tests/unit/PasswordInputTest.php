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

use Illuminate\Support\MessageBag;

require_once 'EdificeTestCase.php';

class PasswordInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimplePasswordInput() {
		$passwordSimple        = $this->edifice->password('user_password');
		$passwordRequiredStyle = $this->edifice->password('user_password', array('class' => 'required', 'required' => 'required'));
		$passwordPlaceholder   = $this->edifice->password('user_password', array('placeholder' => 'Password'));

		$this->assertEquals('<div class="row"><input name="user_password" type="password" value=""></div>', $passwordSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="user_password" type="password" value=""></div>', $passwordRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="Password" name="user_password" type="password" value=""></div>', $passwordPlaceholder);
	}

	public function testPasswordWithTopLabel() {
		$passwordWithLabelTopLeft  = $this->edifice->password('user_password', array('label' => array('text' => 'Password')));
		$passwordWithLabelTopRight = $this->edifice->password('user_password', array('label' => array('text' => 'Password', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_password">Password</label><input name="user_password" type="password" value="" id="user_password"></div>', $passwordWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_password" class="right">Password</label><input name="user_password" type="password" value="" id="user_password"></div>', $passwordWithLabelTopRight);
	}

	public function testPasswordWithInlineLabel() {
		$passwordWithLabelInlineLeft  = $this->edifice->password('user_password', array('label' => array('text' => 'Password', 'inline' => true)));
		$passwordWithLabelInlineRight = $this->edifice->password('user_password', array('label' => array('text' => 'Password', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_password" class="inline">Password</label></div><div class="small-8 large-8 columns"><input name="user_password" type="password" value="" id="user_password"></div></div>', $passwordWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_password" class="inline right">Password</label></div><div class="small-8 large-8 columns"><input name="user_password" type="password" value="" id="user_password"></div></div>', $passwordWithLabelInlineRight);
	}

	public function testPasswordWithPrefix() {
		$passwordWithPrefix = $this->edifice->password('site_url', array('prefix' => array('text' => 'http://')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">http://</span></div><div class="small-8 large-8 columns"><input name="site_url" type="password" value=""></div></div>', $passwordWithPrefix);
	}

	public function testPasswordWithPostfix() {
		$passwordWithPrefix = $this->edifice->password('site_url', array('postfix' => array('text' => '.com')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="site_url" type="password" value=""></div><div class="small-4 large-4 columns"><span class="postfix">.com</span></div></div>', $passwordWithPrefix);
	}

	public function testSimpleWithError() {
		$this->putErrorInSession(array('user_password' => array('Incomplete Password')));

		$passwordSimple = $this->edifice->password('user_password');
		$this->assertEquals('<div class="row error"><input name="user_password" type="password" value=""><small>Incomplete Password</small></div>', $passwordSimple);
	}
}