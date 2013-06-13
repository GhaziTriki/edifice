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

if (!function_exists('array_add_to_key')) {
	/**
	 * Adds a value to an attribute.
	 *
	 * @param $array
	 * @param $key
	 * @param $value
	 */
	function array_add_to_key(&$array, $key, $value) {
		if (!empty($value)) {
			if (array_key_exists($key, $array)) {
				$array[$key] = implode(' ', array($array[$key], $value));
			} else {
				$array = array_add($array, $key, $value);
			}
		}
	}
}

if (!function_exists('array_clean')) {
	/**
	 * Removes keys having empty values from array and trims values.
	 *
	 * @param $array
	 *
	 * @return mixed
	 */
	function array_clean(&$array) {
		foreach ($array as $attribute => $value) {
			if (empty($value)) {
				array_forget($array, $attribute);
			} else {
				$array[$attribute] = trim($value);
			}
		}

		return $array;
	}
}

if (!function_exists('create_div')) {
	/**
	 * Creates a HTML div with a content inside.
	 *
	 * @param array $options
	 * @param       $content
	 *
	 * @return string
	 */
	function create_div(array $options = array(), $content) {
		return open_div($options) . $content . close_div();
	}
}

if (!function_exists('open_div')) {
	/**
	 * Opens a HTML div tag.
	 *
	 * @param array $options
	 *
	 * @return string '</div>'
	 */
	function open_div(array $options = array()) {
		return '<div' . html_attributes($options) . '>';
	}
}


if (!function_exists('close_div')) {
	/**
	 * Closes a HTML div tag.
	 * @return string '</div>'
	 */
	function close_div() {
		return '</div>';
	}
}

if (!function_exists('html_attributes')) {
	/**
	 * A copy of HTMLBuilder htmlAttributes method.
	 *
	 * @param $attributes
	 *
	 * @return string
	 */
	function html_attributes($attributes) {
		$html = array();

		// For numeric keys we will assume that the key and the value are the same
		// as this will convert HTML attributes such as "required" to a correct
		// form like required="required" instead of using incorrect numerics.
		foreach ((array)$attributes as $key => $value) {
			$element = attribute_element($key, $value);

			if (!is_null($element)) {
				$html[] = $element;
			}
		}

		return count($html) > 0 ? ' ' . implode(' ', $html) : '';
	}
}

if (!function_exists('attribute_element')) {
	/**
	 * Build a single attribute element.
	 *
	 * @param  string $key
	 * @param  string $value
	 *
	 * @return string
	 */
	function attribute_element($key, $value) {
		if (is_numeric($key)) {
			$key = $value;
		}

		if (!is_null($value)) {
			return $key . '="' . e($value) . '"';
		}
	}
}