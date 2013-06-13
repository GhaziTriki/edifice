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

namespace Lionart\Edifice\Inputs;

use Lionart\Edifice\Form\Edifice;

/**
 * Class AbstractInput
 * @version 1.0
 * @since   2013-06-09
 * @author  Ghazi Triki <ghazi.nocturne@gmail.com
 * @package Lionart\Edifice\Inputs
 */
abstract class AbstractInput {

	protected $render_method;

	/**
	 * @var \Lionart\Edifice\Form\Edifice
	 */
	protected $edifice;

	public function __construct(Edifice $edifice) {
		$this->edifice = $edifice;
	}

	/**
	 * Render the form input.
	 *
	 * @param       $name
	 * @param null  $value
	 * @param array $options
	 *
	 * @return mixed
	 */
	public function render($name, $value = null, $options = array()) {
		$label   = $this->processLabel($name, $options);
		$prefix  = $this->processPrefix($name, $options);
		$postfix = $this->processPostfix($name, $options);

		if (array_search($this->render_method, get_class_methods(get_class($this->edifice->form))) !== false) {
			return $this->process($name, $this->edifice->form->{$this->render_method}($name, $value, $options), $label, $prefix, $postfix);
		} else {
			// Fallback on HTMLBuilder input method.
			return $this->process($name, $this->edifice->form->input($this->render_method, $name, $value, $options), $label, $prefix, $postfix);
		}
	}

	/**
	 * Processes a HTML input with its label.
	 *
	 * @todo  errors should not be delegated to edifice, but edifice should give them to the input
	 * @fixme inline label creation : should add columns ratio for Foundation CSS Styling
	 *
	 * @param       $name
	 * @param       $tag
	 * @param array $label_opts
	 * @param       $prefix
	 * @param       $postfix
	 *
	 * @return string
	 */
	protected function process($name, $tag, array $label_opts, $prefix = null, $postfix = null) {

		$has_error     = false;
		$error_message = '';
		$errors        = $this->edifice->getErrors($name);
		if (sizeof($errors) > 0) {
			$has_error     = true;
			$error_message = $this->getErrorElement($errors);
		}
		$result = $this->openRow($has_error, isset($prefix), isset($postfix));

		if (isset($label_opts['label'])) {
			if (isset($label_opts['inline']) and $label_opts['inline'] === true) {
				// Inline label creation
				$input_tag = create_div(array('class' => 'small-8 large-8 columns'), $tag . $error_message);
				$result .= $label_opts['label'] . $input_tag . $this->closeRow();
			} else {
				// Label is top of input
				$result .= $label_opts['label'] . $tag . $this->closeRow();
			}
		} elseif (isset($prefix) || isset($postfix)) {
			if (isset($prefix)) {
				$input_tag = create_div(array('class' => 'small-8 large-8 columns'), $tag . $error_message);
				$result .= $prefix . $input_tag;
			}
			if (isset($postfix)) {
				$input_tag = create_div(array('class' => 'small-8 large-8 columns'), $tag . $error_message);
				$result .= $input_tag . $postfix;
			}
			$result .= $this->closeRow();
		} else {
			$result .= $tag . $error_message . $this->closeRow();
		}

		return $result;
	}

	/**
	 * Processes the form input label.
	 *
	 * @param string $name    Form input name
	 * @param array  $options Form input options, label options will be extracted
	 *
	 * @return array
	 */
	protected function processLabel($name, &$options) {
		$label_tag = null;
		$inline    = null;
		if (array_key_exists('label', $options)) {

			$label = array_pull($options, 'label');
			if (array_key_exists('text', $label)) {
				$label = array_add($label, 'class', '');

				$inline = array_pull($label, 'inline');
				$align  = array_pull($label, 'align');
				$text   = array_pull($label, 'text');

				// Processing label inline ( the processing order is important )
				if ($inline === true) {
					array_add_to_key($label, 'class', 'inline');
				}

				if ($align === 'left' or $align === 'right') {
					array_add_to_key($label, 'class', $align);
				}

				array_clean($label);

				$label_tag = $this->edifice->form->label($name, $text, $label);

				if ($inline === true) {
					$label_tag = create_div(array('class' => 'small-4 large-4 columns'), $label_tag);
				}
			}
		}

		return array('label' => $label_tag, 'inline' => $inline);
	}


	/**
	 * Processes the form input prefix.
	 *
	 * @param string $name    Form input name
	 * @param array  $options Form input options, label options will be extracted
	 *
	 * @return string
	 */
	protected function processPrefix($name, &$options) {
		$label_tag = null;
		if (array_key_exists('prefix', $options)) {
			$prefix = array_pull($options, 'prefix');
			if (array_key_exists('text', $prefix)) {
				$text      = array_pull($prefix, 'text');
				$label_tag = $label_tag = create_div(array('class' => 'small-4 large-4 columns'), '<span class="prefix">' . $text . '</span>');
			}
		}

		return $label_tag;
	}

	/**
	 * Processes the form input postfix.
	 *
	 * @param string $name    Form input name
	 * @param array  $options Form input options, label options will be extracted
	 *
	 * @return string
	 */
	protected function processPostfix($name, &$options) {
		$label_tag = null;
		if (array_key_exists('postfix', $options)) {
			$postfix = array_pull($options, 'postfix');
			if (array_key_exists('text', $postfix)) {
				$text = array_pull($postfix, 'text');

				$label_tag = $label_tag = create_div(array('class' => 'small-4 large-4 columns'), '<span class="postfix">' . $text . '</span>');
			}
		}

		return $label_tag;
	}

	/**
	 * Generates the HTML error tag to be displayed
	 *
	 * @param $errors
	 *
	 * @return string
	 */
	protected function getErrorElement($errors) {
		return '<small>' . $errors[0] . '</small>';
	}

	/**
	 * Opens a div using Foundation row as class.
	 *
	 * @param bool $error is set to true when a validation error occurs.
	 * @param bool $prefixed
	 * @param bool $postfixed
	 *
	 * @return string
	 */
	protected function openRow($error = false, $prefixed = false, $postfixed = false) {
		$attr['class'] = 'row';

		if ($error === true) {
			array_add_to_key($attr, 'class', 'error');
		}
		if ($prefixed === true || $postfixed === true) {
			array_add_to_key($attr, 'class', 'collapse');
		}

		return open_div(array('class' => $attr['class']));
	}

	/**
	 * Closes a div.
	 * @return string
	 */
	protected function closeRow() {
		return close_div();
	}

}