<div class="col text-center">
	<form action="/register/check" method="POST" class="form mx-auto">
		<label for="email">Email:</label>
		<input type="text" id="email" name="email" required>
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" minlength="8" maxlength="20" required>
		<input type="submit" name="submit" value="register" class="btn btn-info btn-block">
	</form>
</div>