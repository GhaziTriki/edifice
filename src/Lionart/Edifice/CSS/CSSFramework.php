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

namespace Lionart\Edifice\CSS;

/**
 * CSS Framework configuration contracts.
 *
 * @version 1.0
 * @since   2013-06-14
 * @author  Ghazi Triki <ghazi.nocturne@gmail.com>
 * @package Lionart\Edifice\Form
 */
interface CSSFramework {
	/**
	 * Returns additional custom styles used in form class declaration.
	 *
	 * @return string
	 */
	function useCustom();

	/**
	 * Returns default columns width in large and small screen widths.
	 *
	 * @return array
	 */
	function columns();
}