<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ghazi
 * Date: 10/06/13
 * Time: 09:55
 */

return array(
	'renderers'  => array('email'    => '\Lionart\Edifice\Inputs\EmailInput',
						  'number'   => '\Lionart\Edifice\Inputs\NumberInput',
						  'search'   => '\Lionart\Edifice\Inputs\SearchInput',
						  'tel'      => '\Lionart\Edifice\Inputs\TelInput',
						  'text'     => '\Lionart\Edifice\Inputs\TextInput',
						  'textarea' => '\Lionart\Edifice\Inputs\TextAreaInput'),

	'colmuns'    => array('small' => array('label' => 4, 'input' => 8, 'prefix' => 3, 'postfix' => 3),
						  'large' => array('label' => 4, 'input' => 8, 'prefix' => 3, 'postfix' => 3)),

	'use_custom' => true
);