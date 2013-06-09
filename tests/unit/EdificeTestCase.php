<?php
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Lionart\Edifice\Form\EdificeForm;
use Mockery as m;
use Symfony\Component\Routing\RouteCollection;

/**
 * Created by JetBrains PhpStorm.
 * User: LionArt
 * Date: 09/06/13
 * Time: 13:24
 * To change this template use File | Settings | File Templates.
 */

class EdificeTestCase extends \PHPUnit_Framework_TestCase {
	protected function setUp() {
		$this->urlGenerator = new UrlGenerator(new RouteCollection, Request::create('/foo', 'GET'));
		$this->htmlBuilder  = new HtmlBuilder;
		$this->formBuilder  = new FormBuilder($this->htmlBuilder, $this->urlGenerator, 'csrfToken');
		$this->edifice      = new EdificeForm($this->formBuilder, new Store);
	}
}