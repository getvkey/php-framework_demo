<?php

/**
 * url路由
 */
return [

	'' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],

	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],

	'account/tests' => [
		'controller' => 'account',
		'action' => 'tests',
	],
];