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

class ColorInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleColorInput() {
		$colorSimple        = $this->edifice->color('favorite_color');
		$colorRequiredStyle = $this->edifice->color('favorite_color', '#b5e61d', array('class' => 'required', 'required' => 'required'));
		$colorPlaceholder   = $this->edifice->color('favorite_color', null, array('placeholder' => 'Favorite color'));

		$this->assertEquals('<div class="row"><input name="favorite_color" type="color"></div>', $colorSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="favorite_color" type="color" value="#b5e61d"></div>', $colorRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="Favorite color" name="favorite_color" type="color"></div>', $colorPlaceholder);
	}

	public function testTextWithTopLabel() {
		$colorWithLabelTopLeft  = $this->edifice->color('favorite_color', null, array('label' => array('text' => 'Favorite color')));
		$colorWithLabelTopRight = $this->edifice->color('favorite_color', null, array('label' => array('text' => 'Favorite color', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="favorite_color">Favorite color</label><input name="favorite_color" type="color" id="favorite_color"></div>', $colorWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="favorite_color" class="right">Favorite color</label><input name="favorite_color" type="color" id="favorite_color"></div>', $colorWithLabelTopRight);
	}

	public function testTextWithInlineLabel() {
		$colorWithLabelInlineLeft  = $this->edifice->color('favorite_color', null, array('label' => array('text' => 'Favorite color', 'inline' => true)));
		$colorWithLabelInlineRight = $this->edifice->color('favorite_color', null, array('label' => array('text' => 'Favorite color', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="favorite_color" class="inline">Favorite color</label></div><div class="small-8 large-8 columns"><input name="favorite_color" type="color" id="favorite_color"></div></div>', $colorWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="favorite_color" class="inline right">Favorite color</label></div><div class="small-8 large-8 columns"><input name="favorite_color" type="color" id="favorite_color"></div></div>', $colorWithLabelInlineRight);
	}

	public function testTextWithPrefix() {
		$colorWithPrefix = $this->edifice->color('site_url', '#b5e61d', array('prefix' => array('text' => 'Choose red')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">Choose red</span></div><div class="small-8 large-8 columns"><input name="site_url" type="color" value="#b5e61d"></div></div>', $colorWithPrefix);
	}

	public function testTextWithPostfix() {
		$colorWithPrefix = $this->edifice->color('site_url', '#b5e61d', array('postfix' => array('text' => 'is red')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="site_url" type="color" value="#b5e61d"></div><div class="small-4 large-4 columns"><span class="postfix">is red</span></div></div>', $colorWithPrefix);
	}

	public function testSimpleWithError() {
		$this->putErrorInSession(array('favorite_color' => array('Incorrect Favorite color')));

		$colorSimple = $this->edifice->color('favorite_color');
		$this->assertEquals('<div class="row error"><input name="favorite_color" type="color"><small>Incorrect Favorite color</small></div>', $colorSimple);
	}
}