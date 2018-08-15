<?php
	namespace Core;

	class View {
		function menuToHTML($menu) {
			$menuHTML = '<ul class="menu row">';
			$currentLink = \Helpers\getCurrentLink();
			foreach ($menu as $page => $link) {
				$active = ($currentLink == $link) ? 'btn--active' : '';
				$menuHTML .= '<li class="item col-auto"><a href="' . $link . '" class="btn ' . $active . '">' . $page . '</a></li>';
			}
			$menuHTML .= '</ul>';
			return ($menuHTML);
		}

		/*
		** This function will be individual for each child class.
		*/
		function dataToHtml($data) {
		}

		function show($contentView, $data = null) {
			if (isset($data))
			{
				/*
				** Here we refer to a function that child class contains,
				** NOT to the function written above.
				*/
				$data = $this->dataToHTML($data);
				extract($data);
			}
			require ROOT . 'app/components/templates/template.php';
		}
	}
?>