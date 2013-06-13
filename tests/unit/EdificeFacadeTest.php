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

class EdificeFacadeAccessorTest extends \EdificeTestCase {

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testGetFacadeAccessor() {
		$class             = new ReflectionClass('Lionart\Edifice\Support\Facades\Edifice');
		$getFacadeAccessor = $class->getMethod('getFacadeAccessor');
		$getFacadeAccessor->setAccessible(true);
		$this->assertEquals('edifice.form', $getFacadeAccessor->invoke('Edifice'));
	}

	public function testProvides() {
		$this->assertEquals(array('edifice.form'), $this->edificeServiceProvider->provides());
	}

}