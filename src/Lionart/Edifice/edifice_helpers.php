<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi Triki
 * Date: 10/06/13
 * Time: 10:33
 */


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