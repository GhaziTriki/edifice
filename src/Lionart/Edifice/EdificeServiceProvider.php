<?php namespace Lionart\Edifice;

use Illuminate\Support\ServiceProvider;
use Lionart\Edifice\Form\EdificeForm;

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
			return new EdificeForm($app['form'], $app['session']);
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