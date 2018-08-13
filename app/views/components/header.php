<header>
	<div class="header_btns">
		<?php if (isset($_SESSION['logged_in_user'])): ?>
			<a href="/logout/index" class="btn btn_logout">Logout</a>
		<?php endif ; ?>
		<a href="/main/index" class="btn btn_home">Home</a>
	</div>
</header>