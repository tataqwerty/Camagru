<form action="/register/check" method="POST">
	<?php
		if (isset($error))
			echo $error;
	?>
	<label for="email">Email: </label>
	<input type="text" id="email" name="email" required>
	<label for="username">Username: </label>
	<input type="text" id="username" name="username" required>
	<label for="password">Password: </label>
	<input type="password" id="password" name="password" required>
	<input type="submit" name="submit" value="register">
</form>
<a href="/login/index">Have an account?</a>