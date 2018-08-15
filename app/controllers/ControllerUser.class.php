<?php
	namespace Controllers;

	class ControllerUser extends Controller {
		function isLoggedIn() {
			if (isset($_SESSION['logged_in_user']))
				return (1);
			return (0);
		}
	}
?>