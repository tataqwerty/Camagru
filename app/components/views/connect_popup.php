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

							<div class="popup_form popup_form--active">
								<form id="login_form" action="/login/index" method="POST">
									<div class="form-group">
										<input type="text" name="username" class="form-control username_input" placeholder="Username" pattern="^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]+$" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control password_input" placeholder="Password" pattern="^\w{8,20}$" required>
									</div>
									<div class="form-group">
										<div class="row justify-content-center">
											<div class="col-6">
												<input type="submit" name="submit" class="form-control btn btn-info"
												value="Log In">
											</div>
										</div>
									</div>
								</form>
								<div class="dropdown">
									<div class="row">
										<div class="col text-center">
											<a class="btn_dropdown" data-target="password_reset_form">
												Forgot password?
											</a>
										</div>
									</div>
									<div class="row dropdown_form" id="password_reset_form">
										<div class="col text-center">
											<form action="/password/reset" method="POST">
												<div class="form-group">
													<div class="row">
														<div class="col">
															<input type="email" name="email" class="form-control" placeholder="Email Address" pattern="[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*" required>
														</div>
													</div>
												</div>
												<div class="row justify-content-center">
													<div class="col-6 text-center">
														<input type="submit" name="submit" class="form-control btn btn-info">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="dropdown">
									<div class="row">
										<div class="col text-center">
											<a class="btn_dropdown" data-target="verification_form">
												Get verification key!
											</a>
										</div>
									</div>

									<div class="row dropdown_form" id="verification_form">
										<div class="col text-center">
											<form action="/verify/repeat" method="POST">
												<div class="form-group">
													<div class="row">
														<div class="col">
															<input type="email" name="email" class="form-control" placeholder="Email Address" pattern="[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*" required>
														</div>
													</div>
												</div>
												<div class="row justify-content-center">
													<div class="col-6 text-center">
														<input type="submit" name="submit" class="form-control btn btn-info">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="popup_form">
								<form id="register_form" action="/register/index" method="POST">
									<div class="form-group">
										<input type="text" name="username" class="form-control" placeholder="Username" pattern="^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]+$" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Email Address" pattern="[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control" placeholder="Password" pattern="^\w{8,20}$" required>
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password" pattern="^\w{8,20}$" required>
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
</div>