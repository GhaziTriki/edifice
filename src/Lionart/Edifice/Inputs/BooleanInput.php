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

		$additions = $this->preProcessAdditions($name, $options);

		if (array_search($this->render_method, get_class_methods(get_class($this->edifice->form))) !== false) {
			return $this->process($name, $this->edifice->form->{$this->render_method}($name, $value, $checked, $options), $additions);
		} else {
			// Fallback on HTMLBuilder input method.
			return $this->process($name, $this->edifice->form->input($this->render_method, $name, $value, $checked, $options), $additions);
		}
	}
}