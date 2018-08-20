<?php
	return [
		'profile/index' => '/profile/index',
		'profile/settings' => '/profile/settings',
		'profile/photo' => '/profile/photo',
		'login/index' => '/user/login',
		'logout/index' => '/user/logout',
		'register/index' => '/user/register',
		'password/reset' => '/user/passwordReset',
		'verify/([a-zA-Z0-9]{32})' => '/user/verify/$1',
		'verify/repeat' => '/user/verificationRepeat',
		'profile/index' => '/profile/index',
		'main/index' => '/main/index',
		'main' => '/main/index',
		'' => '/main/index'
	];
?>