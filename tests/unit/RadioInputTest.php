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

class RadioInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleRadio() {
		$radioSimple = $this->edifice->radio('favorite_fruit', 'Kiwi');

		$this->assertEquals('<div class="row"><input style="display:none;" name="favorite_fruit" type="radio" value="Kiwi"></div>', $radioSimple);
	}

	/**
	 * @todo : custom and normal radio inputs should be tested
	 */
	public function testRadioWithLabel() {
		$radioWithLabel = $this->edifice->radio('favorite_fruit', 'Banana', null, array('label' => array('text' => 'Banana')));

		$this->assertEquals('<div class="row"><label for="favorite_fruit"><input style="display:none;" name="favorite_fruit" type="radio" value="Banana" id="favorite_fruit"><span class="custom radio"></span> Banana</label></div>', $radioWithLabel);
	}
}