<div class="container connect_popup">
	<div class="row justify-content-center">
		<div class="col-10 col-sm-8 col-md-6">
			<div class="card card-login">
				<div class="card-header">
					<div class="row">
						<div class="col">
							<a class="active popup_btn" data-target="#login_form">Login</a>
						</div>
						<div class="col">
							<a class="popup_btn" data-target="#register_form">Register</a>
						</div>
						<button type="button" class="close popup_close_btn" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<hr>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col">
							<form class="popup_form popup_form--active" id="login_form" action="/auth/loginCheck" method="POST">
								<div class="form-group">
									<input type="text" name="username" class="form-control" placeholder="Username">
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-6">
											<input type="submit" name="submit" class="form-control btn btn-info"
											value="Log In">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<div class="text-center">	<a href="/auth/passwordReset" class="forgot-password">Forgot Password?</a>
											</div>
										</div>
									</div>
								</div>
							</form>
							<form class="popup_form" id="register_form" action="/auth/registerCheck" method="POST">
								<div class="form-group">
									<input type="text" name="username" class="form-control" placeholder="Username">
								</div>
								<div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="Email Address">
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
								</div>
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-6">
											<input type="submit" name="submit" class="form-control btn btn-info"
											value="Register">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>