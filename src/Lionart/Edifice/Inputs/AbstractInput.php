<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LionArt
 * Date: 09/06/13
 * Time: 19:34
 */

namespace Lionart\Edifice\Inputs;

use Lionart\Edifice\Form\Edifice;

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
		$postfix = $this->processpostfix($name, $options);

		return $this->process($name, $this->edifice->form->{$this->render_method}($name, $value, $options), $label, $prefix, $postfix);
	}

	/**
	 * Processes a HTML input with its label.
	 *
	 * @param       $name
	 * @param       $tag
	 * @param array $label_opts
	 * @param       $prefix
	 *
	 * @return string
	 */
	protected function process($name, $tag, array $label_opts, $prefix = null, $postfix = null) {

		$has_error     = false;
		$error_message = '';
		if (!is_null($this->edifice->errors) and array_key_exists($name, $this->edifice->errors)) {
			$has_error     = true;
			$error_message = '<small>' . $this->edifice->errors[$name][0] . '</small>';
		}
		$result = $this->openRow($has_error, isset($prefix), isset($postfix));

		if (isset($label_opts['label'])) {
			if (isset($label_opts['inline']) and $label_opts['inline'] === true) {
				// FIXME : should add columns ratio for Foundation CSS Styling
				$input_tag = '<div class="small-8 large-8 columns">' . $tag . $error_message . '</div>';
				$result .= $label_opts['label'] . $input_tag . $this->closeRow();
			} else {
				$result .= $label_opts['label'] . $tag . $this->closeRow();
			}
		} elseif (isset($prefix) || isset($postfix)) {
			if (isset($prefix)) {
				$input_tag = '<div class="small-8 large-8 columns">' . $tag . $error_message . '</div>';
				$result .= $prefix . $input_tag;
			}
			if (isset($postfix)) {
				$input_tag = '<div class="small-8 large-8 columns">' . $tag . $error_message . '</div>';
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
					$label_tag = '<div class="small-4 large-4 columns">' . $label_tag . '</div>';
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
				$text = array_pull($prefix, 'text');

				$label_tag = $label_tag = '<div class="small-4 large-4 columns">' . '<span class="prefix">' . $text . '</span>' . '</div>';
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
	protected function processpostfix($name, &$options) {
		$label_tag = null;
		if (array_key_exists('postfix', $options)) {
			$postfix = array_pull($options, 'postfix');
			if (array_key_exists('text', $postfix)) {
				$text = array_pull($postfix, 'text');

				$label_tag = $label_tag = '<div class="small-4 large-4 columns">' . '<span class="postfix">' . $text . '</span>' . '</div>';
			}
		}

		return $label_tag;
	}

	/**
	 * Opens a div using Founcation row as class.
	 *
	 * @param bool $error is set to true when a validation error occurs.
	 * @param bool $prefixed
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

		return '<div class="' . $attr['class'] . '">';
	}

	/**
	 * Closes a div.
	 * @return string
	 */
	protected function closeRow() {
		return '</div>';
	}

}