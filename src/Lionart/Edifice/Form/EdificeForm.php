<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi
 * Date: 05/06/13
 * Time: 10:23
 */

namespace Lionart\Edifice\Form;

use Illuminate\Html\FormBuilder;

class EdificeForm {


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
		return $this->form->input($type, $name, $value, $options);
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
		$label = $this->processLabel($name, $options);

		return $this->processItem($this->form->text($name, $value, $options), $label);
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
		return $this->form->password($name, $options);
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
		return $this->form->email($name, $value, $options);
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
		return $this->form->file($name, $options);
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
		return $this->form->textarea($name, $value, $options);
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
		return $this->form->select($name, $list, $selected, $options);
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
		return $this->form->checkbox($name, $value, $checked, $options);
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
		return $this->form->radio($name, $value, $checked, $options);
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
		return $this->form->getSessionStore();
	}

	/**
	 * Set the session store implementation.
	 *
	 * @param  \Illuminate\Session\Store $session
	 *
	 * @return \Illuminate\Html\FormBuilder
	 */
	public function setSessionStore(Session $session) {
		return $this->form->setSessionStore($session);
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

	/**
	 * Opens a div using Founcation row as class.²
	 *
	 * @return string
	 */
	protected function openRow() {
		return '<div class="row">';
	}

	/**
	 * Closes a div.
	 * @return string
	 */
	protected function closeRow() {
		return '</div>';
	}

	/**
	 * Unsets a value from array then returns it.
	 *
	 * @param $array Array having a value to be unset
	 * @param $key   The key that will be used to unset.
	 *
	 * @return mixed
	 */
	private function unsetFromArray($key, array &$array) {
		if (array_key_exists($key, $array)) {
			$value = $array[$key];
			unset($array[$key]);
		}

		return isset($value) ? $value : null;
	}

	/**
	 * Initialises an array key it does not exist.
	 *
	 * @param       $key
	 * @param array $array
	 */
	private function initInArrayIfNotSet($key, array &$array) {
		if (!array_key_exists($key, $array)) {
			$array[$key] = '';
		}
	}

	/**
	 * Processes the form input label.
	 *
	 * @param $name    Form input name
	 * @param $options Form input options, label options will be extracted
	 *
	 * @return array
	 */
	protected function processLabel($name, &$options) {
		$label_tag = null;
		$inline    = null;
		if (array_key_exists('label', $options)) {

			$label = $this->unsetFromArray('label', $options);
			if (array_key_exists('text', $label)) {
				$this->initInArrayIfNotSet('class', $label);

				$inline = $this->unsetFromArray('inline', $label);
				$align  = $this->unsetFromArray('align', $label);
				$text   = $this->unsetFromArray('text', $label);

				// Processing label inline ( the processing order is importantF )
				if ($inline === true) {
					$label['class'] = implode(' ', array('inline', $label['class']));
				}

				// Processing label alignment
				if ($align === 'left') {
					$label['class'] = implode(' ', array('left', $label['class']));
				} elseif ($align === 'right') {
					$label['class'] = implode(' ', array('right', $label['class']));
				}

				$label_tag = $this->form->label($name . '_label', $text, $label);

				if ($inline === true) {
					$label_tag = '<div class="small-4 columns">' . $label_tag . '</div>';
				}
			}
		}

		return array('label' => $label_tag, 'inline' => $inline);
	}

	/**
	 * @param       $tag
	 * @param array $label_inline
	 */
	protected function processItem($tag, array $label_opts) {

		$result = $this->openRow();

		if (isset($label_opts['label']) && isset($label_opts['inline']) && $label_opts['inline'] === true) {
			$input_tag = '<div class="small-8 columns">' . $tag . '</div>';
			$result .= $label_opts['label'] . $input_tag . $this->closeRow();
		} else {
			$result .= $tag . $this->closeRow();
		}

		return $result;
	}
}