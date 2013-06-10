<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LionArt
 * Date: 09/06/13
 * Time: 19:34
 * To change this template use File | Settings | File Templates.
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
		$label = $this->processLabel($name, $options);

		return $this->process($name, $this->edifice->form->{$this->render_method}($name, $value, $options), $label);
	}

	/**
	 * Processes a HTML input with its label.
	 *
	 * @param string $tag
	 * @param array  $label_opts
	 *
	 * @return string
	 */
	protected function process($name, $tag, array $label_opts, $wrap = true) {

		$has_error     = false;
		$error_message = '';
		if (!is_null($this->edifice->errors) and array_key_exists($name, $this->edifice->errors)) {
			$has_error     = true;
			$error_message = '<small>' . $this->edifice->errors[$name][0] . '</small>';
		}
		$result = $this->openRow($has_error);

		if (isset($label_opts['label'])) {
			if ($wrap or isset($label_opts['inline']) and $label_opts['inline'] === true) {
				// FIXME : should add columns ratio for Foundation CSS Styling
				// $input_tag = '<div class="small-8 columns">' . $tag . $error_message . '</div>';
				$input_tag = $tag . $error_message;
				$result .= $label_opts['label'] . $input_tag . $this->closeRow();
			} else {
				$result .= $tag . $label_opts['label'] . $this->closeRow();
			}
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
	protected function processLabel($name, &$options, $wrap = true) {
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
					$label['class'] = implode(' ', array('inline', $label['class']));
				}

				// Processing label alignment
				if ($align === 'left') {
					$label['class'] = implode(' ', array('left', $label['class']));
				} elseif ($align === 'right') {
					$label['class'] = implode(' ', array('right', $label['class']));
				}

				array_clean($label);

				$label_tag = $this->edifice->form->label($name, $text, $label);

				if ($inline === true and $wrap === true) {
					$label_tag = '<div class="small-4 columns">' . $label_tag . '</div>';
				}
			}
		}

		return array('label' => $label_tag, 'inline' => $inline);
	}

	/**
	 * Opens a div using Founcation row as class.
	 *
	 * @param bool $error is set to true when a validation error occured.
	 *
	 * @return string
	 */
	protected function openRow($error = false) {
		if ($error === false) {
			return '<div class="row">';
		} else {
			return '<div class="row error">';
		}
	}

	/**
	 * Closes a div.
	 * @return string
	 */
	protected function closeRow() {
		return '</div>';
	}

}