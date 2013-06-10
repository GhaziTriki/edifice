<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi
 * Date: 05/06/13
 * Time: 10:23
 */

namespace Lionart\Edifice\Form;

use Illuminate\Html\FormBuilder;
use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;
use Lionart\Edifice\Inputs\Text;

class Edifice {


	/**
	 * @var \Illuminate\Support\MessageBag
	 */
	public $errors;

	/**
	 * The session store implementation.
	 *
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	// TODO : externalise to a configuration file
	private $render_map = array('text'     => '\Lionart\Edifice\Inputs\Text',
								'textarea' => '\Lionart\Edifice\Inputs\Textarea');

	/**
	 * Create a new form builder instance.
	 *
	 * @param  \Illuminate\Html\FormBuilder $form
	 *
	 * @return void
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
		if (isset($this->session)) {
			$this->errors = $this->session->get('errors');
		}

		if (!is_null($this->errors)) {
			$this->errors = $this->errors->getMessages();
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
		$this->errors = null;

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

		$label = $this->processLabel($name, $options);

		return $this->processItem($name, $this->form->input($type, $name, $value, $options), $label);
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
		// TODO : use configuration to load default renderer class or user custom class
		$text = new $this->render_map['text']($this);

		return $text->render($name, $value, $options);
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
		$label = $this->processLabel($name, $options);

		return $this->processItem($name, $this->form->password($name, $options), $label);
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
		return $this->form->password($name, $value, $options);
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
		$label = $this->processLabel($name, $options);

		return $this->processItem($name, $this->form->email($name, $value, $options), $label);
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
		$label = $this->processLabel($name, $options);

		return $this->processItem($name, $this->form->file($name, $options), $label);
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

		// TODO : use configuration to load default renderer class or user custom class
		$text = new $this->render_map['textarea']($this);

		return $text->render($name, $value, $options);
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
		$label = $this->processLabel($name, $options);

		return $this->processItem($name, $this->form->select($name, $list, $selected, $options), $label);
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
		$label = $this->processLabel($name, $options, false);

		return $this->processItem($name, $this->form->checkbox($name, $value, $checked, $options), $label, false);
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
		$label = $this->processLabel($name, $options);

		return $this->processItem($name, $this->form->radio($name, $value, $checked, $options), $label);
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
	 * @return \Illuminate\Html\FormBuilder
	 */
	public function setSessionStore(Session $session) {
		$this->session = $session;

		return $this;
	}

	/**
	 * Dynamically handle calls to the form builder.
	 *
	 * @param  string $method
	 * @param  array  $parameters
	 *
	 * @return mixed
	 */
	public function __call($method, $parameters) {
		if (isset($this->macros[$method])) {
			return call_user_func_array($this->macros[$method], $parameters);
		}

		throw new \BadMethodCallException("Method {$method} does not exist.");
	}

}