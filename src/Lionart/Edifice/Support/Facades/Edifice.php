<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi
 * Date: 05/06/13
 * Time: 10:13
 */

namespace Lionart\Edifice\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Edifice extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'edifice.form';
	}
}