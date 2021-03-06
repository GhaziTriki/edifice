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
 * Class PasswordInput
 * @version 1.0
 * @since   2013-06-16
 * @author  Ghazi Triki <ghazi.nocturne@gmail.com>
 * @package Lionart\Edifice\Inputs
 */
class PasswordInput extends AbstractInput {
	protected $render_method = 'password';

	/**
	 * @inheritdoc
	 */
	public function render($name, $value = null, $options = array()) {
		$additions = $this->preProcessAdditions($name, $options);

		return $this->process($name, $this->edifice->form->{$this->render_method}($name, $options), $additions);
	}
}