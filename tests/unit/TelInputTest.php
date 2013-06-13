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
 * along with this program. If not, see <+216www.gnu.org/licenses/>.
 */

use Illuminate\Support\MessageBag;

require_once 'EdificeTestCase.php';

class TelInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleTextInput() {
		$telSimple        = $this->edifice->tel('user_phone');
		$telRequiredStyle = $this->edifice->tel('user_phone', 'Ghazi', array('class' => 'required', 'required' => 'required'));
		$telPlaceholder   = $this->edifice->tel('user_phone', null, array('placeholder' => '411600'));

		$this->assertEquals('<div class="row"><input name="user_phone" type="tel"></div>', $telSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="user_phone" type="tel" value="Ghazi"></div>', $telRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="411600" name="user_phone" type="tel"></div>', $telPlaceholder);
	}

	public function testTextWithTopLabel() {
		$telWithLabelTopLeft  = $this->edifice->tel('user_phone', null, array('label' => array('text' => '411600')));
		$telWithLabelTopRight = $this->edifice->tel('user_phone', null, array('label' => array('text' => '411600', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_phone">411600</label><input name="user_phone" type="tel" id="user_phone"></div>', $telWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_phone" class="right">411600</label><input name="user_phone" type="tel" id="user_phone"></div>', $telWithLabelTopRight);
	}

	public function testTextWithInlineLabel() {
		$telWithLabelInlineLeft  = $this->edifice->tel('user_phone', null, array('label' => array('text' => '411600', 'inline' => true)));
		$telWithLabelInlineRight = $this->edifice->tel('user_phone', null, array('label' => array('text' => '411600', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_phone" class="inline">411600</label></div><div class="small-8 large-8 columns"><input name="user_phone" type="tel" id="user_phone"></div></div>', $telWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_phone" class="inline right">411600</label></div><div class="small-8 large-8 columns"><input name="user_phone" type="tel" id="user_phone"></div></div>', $telWithLabelInlineRight);
	}

	public function testTextWithPrefix() {
		$telWithPrefix = $this->edifice->tel('site_url', '411', array('prefix' => array('text' => '+216')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">+216</span></div><div class="small-8 large-8 columns"><input name="site_url" type="tel" value="411"></div></div>', $telWithPrefix);
	}

	public function testTextWithPostfix() {
		$telWithPrefix = $this->edifice->tel('site_url', '200', array('postfix' => array('text' => '.com')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="site_url" type="tel" value="200"></div><div class="small-4 large-4 columns"><span class="postfix">.com</span></div></div>', $telWithPrefix);
	}

	public function testSimpleWithError() {
		$this->putErrorInSession(array('user_phone' => array('Incomplete phone number')));

		$telSimple = $this->edifice->tel('user_phone');
		$this->assertEquals('<div class="row error"><input name="user_phone" type="tel"><small>Incomplete phone number</small></div>', $telSimple);
	}
}