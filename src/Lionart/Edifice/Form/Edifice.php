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

namespace Lionart\Edifice\Form;

use Illuminate\Html\FormBuilder;
use Illuminate\Session\Store;
use Lionart\Edifice\Inputs\AbstractInput;
use Lionart\Edifice\Inputs\Input;

/**
 * Class Edifice
 * @version 1.0
 * @since   2013-06-05
 * @author  Ghazi Triki <ghazi.nocturne@gmail.com>
 * @package Lionart\Edifice\Form
 */
class Edifice {

	/**
	 * The session store implementation.
	 *
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * The form configuration.
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * Create a new form builder instance.
	 *
	 * @param  \Illuminate\Html\FormBuilder $form
	 *
	 */
	public function __construct(FormBuilder $form) {
		$this->form = $form;
	}

	/**
	 * Open up a new HTML form.
	 *
	 * @param  array $options
	 *
	 * @return string
	 */
	public function open(array $options = array()) {
		if (isset($this->config['use_custom']) and $this->config['use_custom'] == true) {
			array_add_to_key($options, 'class', 'custom');
		}

		return $this->form->open($options);
	}

	/**
	 * Create a new model based form builder.
	 *
	 * @param  mixed $model
	 * @param  array $options
	 *
	 * @return string
	 */
	public function model($model, array $options = array()) {
		return $this->form->model($model, $options);
	}

	/**
	 * Close the current form.
	 *
	 * @return string
	 */
	public function close() {
		return $this->form->close();
	}

	/**
	 * Generate a hidden field with the current CSRF token.
	 *
	 * @return string
	 */
	public function token() {
		return $this->form->token();
	}

	/**
	 * Create a form label element.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function label($name, $value = null, $options = array()) {
		return $this->form->label($name, $value, $options);
	}

	/**
	 * Create a form input field.
	 *
	 * @param  string $type
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function input($type, $name, $value = null, $options = array()) {

		$input = new Input($this);
		$input->setType($type);

		return $input->render($name, $value, $options);
	}

	/**
	 * Create a text input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function text($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('text')->render($name, $value, $options);
	}

	/**
	 * Create a password input field.
	 *
	 * @param  string $name
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function password($name, $options = array()) {
		return $this->getInputRendererFactory('password')->render($name, null, $options);
	}

	/**
	 * Create a hidden input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function hidden($name, $value = null, $options = array()) {
		return $this->form->hidden($name, $value, $options);
	}

	/**
	 * Create an e-mail input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function email($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('email')->render($name, $value, $options);
	}

	/**
	 * Create a number input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function number($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('number')->render($name, $value, $options);
	}

	/**
	 * Create a search input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function search($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('search')->render($name, $value, $options);
	}

	/**
	 * Create a tel input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function tel($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('tel')->render($name, $value, $options);
	}

	/**
	 * Create a colorR input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function color($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('color')->render($name, $value, $options);
	}

	/**
	 * Create a file input field.
	 *
	 * @param  string $name
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function file($name, $options = array()) {
		return $this->getInputRendererFactory('file')->render($name, $options);
	}

	/**
	 * Create a textarea input field.
	 *
	 * @param  string $name
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function textarea($name, $value = null, $options = array()) {
		return $this->getInputRendererFactory('textarea')->render($name, $value, $options);
	}

	/**
	 * Create a select box field.
	 *
	 * @param  string $name
	 * @param  array  $list
	 * @param  string $selected
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function select($name, $list = array(), $selected = null, $options = array()) {
		return $this->getInputRendererFactory('select')->render($name, $list, $selected, $options);
	}

	/**
	 * Create a checkbox input field.
	 *
	 * @param  string $name
	 * @param  mixed  $value
	 * @param  bool   $checked
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function checkbox($name, $value = 1, $checked = null, $options = array()) {
		$options['checked'] = $checked;

		return $this->getInputRendererFactory('checkbox')->render($name, $value, $options);
	}

	/**
	 * Create a radio button input field.
	 *
	 * @param  string $name
	 * @param  mixed  $value
	 * @param  bool   $checked
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function radio($name, $value = null, $checked = null, $options = array()) {
		$options['checked'] = $checked;

		return $this->getInputRendererFactory('radio')->render($name, $value, $options);
	}

	/**
	 * Create a HTML reset input element.
	 *
	 * @param  string $value
	 * @param  array  $attributes
	 *
	 * @return string
	 */
	public function reset($value, $attributes = array()) {
		return $this->form->reset($value, $attributes);
	}

	/**
	 * Create a HTML image input element.
	 *
	 * @param  string $url
	 * @param  string $name
	 * @param  array  $attributes
	 *
	 * @return string
	 */
	public function image($url, $name = null, $attributes = array()) {
		return $this->form->image($url, $name, $attributes);
	}

	/**
	 * Create a submit button element.
	 *
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function submit($value = null, $options = array()) {
		return $this->form->submit($value, $options);
	}

	/**
	 * Create a button element.
	 *
	 * @param  string $value
	 * @param  array  $options
	 *
	 * @return string
	 */
	public function button($value = null, $options = array()) {
		return $this->form->button($value, $options);
	}

	/**
	 * Register a custom form macro.
	 *
	 * @param  string   $name
	 * @param  callable $macro
	 *
	 * @return void
	 */
	public function macro($name, $macro) {
		return $this->form->macro($name, $macro);
	}

	/**
	 * Get the session store implementation.
	 *
	 * @return  \Illuminate\Session\Store  $session
	 */
	public function getSessionStore() {
		return $this->session;
	}

	/**
	 * Set the session store implementation.
	 *
	 * @param  \Illuminate\Session\Store $session
	 *
	 * @return $this
	 */
	public function setSessionStore(Store $session) {
		$this->session = $session;

		return $this;
	}


	/**
	 * @param $key The name of the input containing the error.
	 *
	 * @return array
	 */
	public function getErrors($key) {
		if (isset($this->session) and !is_null($this->session->get('errors'))) {
			return $this->session->get('errors')->get($key);
		}

		return array();
	}

	/**
	 * Returns Edifice configuration.
	 *
	 * @return array
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * Sets the configuration.
	 *
	 * @param array $config
	 */
	public function setConfig(array $config) {
		$this->config = array_dot($config);
	}

	/**
	 * Returns an instance of the renderer class assigned to an input.
	 *
	 * @param $input HTML Input name
	 *
	 * @return \Lionart\Edifice\Inputs\AbstractInput
	 */
	private function getInputRendererFactory($input) {
		return new $this->config['renderers.' . $input]($this);
	}

	/**
	 * Dynamically handle calls to the form builder.
	 *
	 * @param  string $method
	 * @param  array  $parameters
	 *
	 * @return mixed
	 * @throws \BadMethodCallException
	 */
	public function __call($method, $parameters) {
		if (isset($this->macros[$method])) {
			return call_user_func_array($this->macros[$method], $parameters);
		}

		throw new \BadMethodCallException("Method {$method} does not exist.");
	}

}