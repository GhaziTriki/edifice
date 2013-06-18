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

/**
 * Class BooleanInput
 * @version 1.0
 * @since   2013-06-13
 * @author  Ghazi Triki <ghazi.nocturne@gmail.com>
 * @package Lionart\Edifice\Inputs
 */
abstract class BooleanInput extends AbstractInput {

	/**
	 * @inheritdoc
	 */
	public function render($name, $value = null, $options = array()) {
		$checked = array_pull($options, 'checked');

		// Custom input for Foundation
		array_add($options, 'style', '');
		array_add_to_key($options, 'style', 'display:none;');

		$additions = $this->preProcessAdditions($name, $options);

		return $this->process($name, $this->edifice->form->{$this->render_method}($name, $value, $checked, $options), $additions);
	}

	/**
	 * @inheritdoc
	 * @todo : refactor prefix and sufffix concatenation
	 */
	protected function process($name, $tag, $additions = array()) {

		// Extracted variables are label, prefix and postfix
		extract($additions);

		$has_error     = false;
		$error_message = '';
		$errors        = $this->edifice->getErrors($name);
		if (sizeof($errors) > 0) {
			$has_error     = true;
			$error_message = $this->getErrorElement($errors);
		}
		$result = $this->openRow($has_error, isset($prefix), isset($postfix));

		if (isset($label['label'])) {
			$label['label'] = preg_replace('/>/', '>' . $tag, $label['label'], 1);
			$result .= html_entity_decode($label['label']) . $this->closeRow();
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
	 * @inheritdoc
	 * @todo : 'custom' form property should be handled, for now it is always activated
	 */
	protected function processLabel($name, &$options) {
		$label_tag = null;
		if (array_key_exists('label', $options)) {

			$label = array_pull($options, 'label');
			if (array_key_exists('text', $label)) {
				$label = array_add($label, 'class', '');

				$text = array_pull($label, 'text');

				array_clean($label);

				$label_tag = $this->edifice->form->label($name, '<span class="custom radio"></span> ' . $text, $label);
			}
		}

		return array('label' => $label_tag);
	}
}