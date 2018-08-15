<?php
	return [
		'logged-out' => [
			'/main/index' => 'Home',
			'#connect_popup' => 'Connect'
		],
		'logged-in' => [
			'/main/index' => 'Home',
			'/profile/index' => 'Profile',
			'/logout/index/' => 'Logout'
		]
	];
?>