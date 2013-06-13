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

namespace Lionart\Edifice;

use Illuminate\Support\ServiceProvider;
use Lionart\Edifice\Form\Edifice as EdificeFormBuilder;

/**
 * Class EdificeServiceProvider
 * @version  1.0
 * @since    2013-06-05
 * @author   Ghazi Triki <ghazi.nocturne@gmail.com
 * @package  Lionart\Edifice\Support
 */
class EdificeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot() {
		$this->package('lionart/edifice');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->app['edifice.form'] = $this->app->share(function ($app) {
			$edifice = new EdificeFormBuilder($app['form']);

			return $edifice->setSessionStore($app['session']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return array('edifice.form');
	}

}