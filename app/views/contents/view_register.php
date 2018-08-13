<form action="/register/check" method="POST">
	<?php
		if (isset($error))
			echo $error;
	?>
	<label for="email">Email: </label>
	<input type="text" id="email" name="email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required>
	<label for="username">Username: </label>
	<input type="text" id="username" name="username" pattern="^[a-zA-Z0-9]+$" required>
	<label for="password">Password: </label>
	<input type="password" id="password" name="password" minlength="8" pattern="^[^\s]+$" maxlength="20" required>
	<input type="submit" name="submit" value="register">
</form>
<a href="/login/index">Have an account?</a>