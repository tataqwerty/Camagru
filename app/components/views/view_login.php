<div class="col text-center">
	<form action="/login/check" method="POST" class="form mx-auto">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" minlength="8" maxlength="20" auto-complete="current-password" required>
		<input type="submit" name="submit" value="login" class="btn btn-info btn-block">
	</form>
</div>
