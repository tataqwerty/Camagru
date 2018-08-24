<?php
	return [
		'profile' => '/user/profile/me',
		'profile/index' => '/user/profile/me',
		'profile/me' => '/user/profile/me',
		'profile/id/(\d+|me)' => '/user/profile/$1',
		'profile/settings' => '/user/settings',
		'profile/photo' => '/user/photo',
		'profile/photo/merge' => '/user/photoMerge',
		'profile/photo/sidebar' => '/user/getSidebar',
		'profile/photo/save' => '/user/saveImage',
		'login/index' => '/auth/login',
		'login' => '/auth/login',
		'logout/index' => '/auth/logout',
		'logout' => '/auth/logout',
		'register/index' => '/auth/register',
		'password/reset' => '/auth/passwordReset',
		'verify/([a-zA-Z0-9]{32})' => '/auth/verify/$1',
		'verify/repeat' => '/auth/verificationRepeat',
		'main/index' => '/main/index',
		'main' => '/main/index',
		'' => '/main/index'
	];
?>