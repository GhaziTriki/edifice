<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi Triki
 * Date: 11/06/13
 * Time: 16:01
 */

use Lionart\Edifice\Support\Facades\Edifice;

class EdificeFacadeAccessorTest extends \PHPUnit_Framework_TestCase {

	public function testGetFacadeAccessor() {
		$class             = new ReflectionClass('Lionart\Edifice\Support\Facades\Edifice');
		$getFacadeAccessor = $class->getMethod('getFacadeAccessor');
		$getFacadeAccessor->setAccessible(true);
		$this->assertEquals('edifice.form', $getFacadeAccessor->invoke('Edifice'));
	}

}