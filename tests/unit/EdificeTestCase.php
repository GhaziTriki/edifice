<?php
use Illuminate\Foundation\Application;
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Lionart\Edifice\EdificeServiceProvider;
use Lionart\Edifice\Form\Edifice;
use Mockery as m;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Created by JetBrains PhpStorm.
 * User: LionArt
 * Date: 09/06/13
 * Time: 13:24
 * To change this template use File | Settings | File Templates.
 */

class EdificeTestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \Illuminate\Container\Container
	 */
	protected $app;

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

	protected function setUp() {

		$app = new \Illuminate\Container\Container();

		$app['session'] = $this->session = new Store(new MockArraySessionStorage());
		$app['url']     = $this->urlGenerator = new UrlGenerator(new RouteCollection, Request::create('/edifice', 'GET'));
		$app['html']    = $this->htmlBuilder = new HtmlBuilder($this->urlGenerator);
		$app['form']    = $this->formBuilder = new FormBuilder($this->htmlBuilder, $this->urlGenerator, 'csrfToken');

		$edificeServiceProvider = new \Lionart\Edifice\EdificeServiceProvider($app);
		$edificeServiceProvider->register();
		$this->edifice = $app['edifice.form'];

		$app->instance('Illuminate\Container\Container', $app);
	}
}