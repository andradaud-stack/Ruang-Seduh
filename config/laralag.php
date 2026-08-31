<?php

return [
	'module_exception' => ['login', 'register', 'password', 'verification', 'logout', // auth
							'dashboard', 'frontend', 'profile'],

	'translate_action' => [
		'index'         => 'read',
		'management'    => 'read',
		'show'          => 'show',
		'create'        => 'create',
		'store'         => 'create',
		'edit'          => 'update',
		'update'        => 'update',
		'update-status' => 'update',
		'destroy'       => 'delete',
		'delete'        => 'delete'
	],

	'login_using' => env('LOGIN_USING', 'email'),
];
