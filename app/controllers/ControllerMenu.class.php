<?php
	namespace Controllers;

	use Core\Controller as Controller;
	use Models\ModelMenu as ModelMenu;

	class ControllerMenu extends Controller {
		static function getMenu(ControllerUser $user, ControllerURI $URI) {
			$arrayMenu = ModelMenu::getMenu();
			$menu = '<ul class="nav">';
			foreach ($arrayMenu as $item)
			{
				if ()
			}
			$menu .= '</ul>';
			return ($menu);
		}
	}
?>