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

class SearchInputTest extends EdificeTestCase {
	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	public function testSimpleTextInput() {
		$searchSimple        = $this->edifice->search('user_search');
		$searchRequiredStyle = $this->edifice->search('user_search', 'Ghazi', array('class' => 'required', 'required' => 'required'));
		$searchPlaceholder   = $this->edifice->search('user_search', null, array('placeholder' => 'Search'));

		$this->assertEquals('<div class="row"><input name="user_search" type="search"></div>', $searchSimple);
		$this->assertEquals('<div class="row"><input class="required" required="required" name="user_search" type="search" value="Ghazi"></div>', $searchRequiredStyle);
		$this->assertEquals('<div class="row"><input placeholder="Search" name="user_search" type="search"></div>', $searchPlaceholder);
	}

	public function testTextWithTopLabel() {
		$searchWithLabelTopLeft  = $this->edifice->search('user_search', null, array('label' => array('text' => 'Search')));
		$searchWithLabelTopRight = $this->edifice->search('user_search', null, array('label' => array('text' => 'Search', 'align' => 'right')));

		$this->assertEquals('<div class="row"><label for="user_search">Search</label><input name="user_search" type="search" id="user_search"></div>', $searchWithLabelTopLeft);
		$this->assertEquals('<div class="row"><label for="user_search" class="right">Search</label><input name="user_search" type="search" id="user_search"></div>', $searchWithLabelTopRight);
	}

	public function testTextWithInlineLabel() {
		$searchWithLabelInlineLeft  = $this->edifice->search('user_search', null, array('label' => array('text' => 'Search', 'inline' => true)));
		$searchWithLabelInlineRight = $this->edifice->search('user_search', null, array('label' => array('text' => 'Search', 'inline' => true, 'align' => 'right')));

		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_search" class="inline">Search</label></div><div class="small-8 large-8 columns"><input name="user_search" type="search" id="user_search"></div></div>', $searchWithLabelInlineLeft);
		$this->assertEquals('<div class="row"><div class="small-4 large-4 columns"><label for="user_search" class="inline right">Search</label></div><div class="small-8 large-8 columns"><input name="user_search" type="search" id="user_search"></div></div>', $searchWithLabelInlineRight);
	}

	public function testTextWithPrefix() {
		$searchWithPrefix = $this->edifice->search('site_url', 'github.com', array('prefix' => array('text' => 'http://')));

		$this->assertEquals('<div class="row collapse"><div class="small-4 large-4 columns"><span class="prefix">http://</span></div><div class="small-8 large-8 columns"><input name="site_url" type="search" value="github.com"></div></div>', $searchWithPrefix);
	}

	public function testTextWithPostfix() {
		$searchWithPrefix = $this->edifice->search('site_url', 'github', array('postfix' => array('text' => '.com')));

		$this->assertEquals('<div class="row collapse"><div class="small-8 large-8 columns"><input name="site_url" type="search" value="github"></div><div class="small-4 large-4 columns"><span class="postfix">.com</span></div></div>', $searchWithPrefix);
	}

	public function testSimpleWithError() {
		$this->putErrorInSession(array('user_search' => array('Incomplete Search')));

		$searchSimple = $this->edifice->search('user_search');
		$this->assertEquals('<div class="row error"><input name="user_search" type="search"><small>Incomplete Search</small></div>', $searchSimple);
	}
}