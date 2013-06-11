<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi Triki
 * Date: 10/06/13
 * Time: 10:33
 */


if (!function_exists('array_add_to_key')) {
	/**
	 * Adds a value to class attribute.
	 *
	 * @param $array
	 * @param $value
	 */
	function array_add_to_key(&$array, $key, $value) {
		if (!empty($value)) {
			$array[$key] = implode(' ', array($array[$key], $value));
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

if (!function_exists('open_div')) {
	/**
	 * Opens a HTML div tag.
	 * @return string '</div>'
	 */
	function open_div(array $options = array()) {
		return '<div ' . app('html')->attributes($options) . '>';
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