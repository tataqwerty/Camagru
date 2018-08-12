<form action="/login/check" method="POST">
	<?php
		if (isset($error))
			echo $error;
	?>
	<label for="username">Username: </label>
	<input type="text" id="username" name="username" required>
	<label for="password">Password: </label>
	<input type="password" id="password" name="password" required>
	<input type="submit" name="submit" value="login">
</form>
<a href="/register/index">Register</a>