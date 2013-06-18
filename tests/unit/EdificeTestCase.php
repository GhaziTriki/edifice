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

use Illuminate\Config\FileLoader;
use Illuminate\Config\Repository;
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;
use Lionart\Edifice\EdificeServiceProvider;
use Lionart\Edifice\Form\Edifice;
use Mockery as m;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Routing\RouteCollection;

class EdificeTestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \Illuminate\Container\Container
	 */
	protected $app;

	/**
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $urlGenerator;

	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * @var \Illuminate\Html\HtmlBuilder
	 */
	protected $htmlBuilder;

	/**
	 * @var \Illuminate\Html\FormBuilder
	 */
	protected $formBuilder;

	/**
	 * @var \Lionart\Edifice\Form\Edifice
	 */
	protected $edifice;

	/**
	 * @var \Lionart\Edifice\EdificeServiceProvider
	 */
	protected $edificeServiceProvider;

	protected function setUp() {

		$app = new \Illuminate\Container\Container();

		$app['config']  = $this->config = $this->generateMockConfiguration();
		$app['session'] = $this->session = new Store(new MockArraySessionStorage());
		$app['url']     = $this->urlGenerator = new UrlGenerator(new RouteCollection, Request::create('/edifice', 'GET'));
		$app['html']    = $this->htmlBuilder = new HtmlBuilder($this->urlGenerator);
		$app['form']    = $this->formBuilder = new FormBuilder($this->htmlBuilder, $this->urlGenerator, 'csrfToken');

		$this->edificeServiceProvider = new EdificeServiceProvider($app);
		$this->edificeServiceProvider->register();
		$this->edifice = $app['edifice.form'];

		$app->make('Illuminate\Container\Container');
		$app->instance('Illuminate\Container\Container', $app);
	}

	protected function putErrorInSession($messages) {
		$errors = new MessageBag($messages);
		$this->session->set('errors', $errors);
	}

	private function generateMockConfiguration() {

		$config      = m::mock('Illuminate\Config\Repository');
		$config_data = include(__DIR__ . '/../../src/config/edifice.php');
		$config->shouldReceive('get')->with('edifice::edifice')->andReturn($config_data);

		return $config;
	}
}