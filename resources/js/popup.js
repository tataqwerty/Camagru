(() => {
	var connectBtn = document.querySelector('.connect_btn');
	var popup = document.querySelector('.connect_popup');
	var closeBtn = popup.querySelector('.popup_close_btn');
	var popupBtns = document.querySelectorAll('.popup_btn');
	var popupForms = document.querySelectorAll('.popup_form');

	if (connectBtn)
	{
		connectBtn.addEventListener('click', (e) => {
			e.preventDefault();
			popup.classList.add('connect_popup--show');
		});

		closeBtn.addEventListener('click', () => popup.classList.remove('connect_popup--show'));

		popupBtns.forEach((popupBtn) => {
			popupBtn.addEventListener('click', (e) => {
				popupBtns.forEach((popupBtn) => popupBtn.classList.remove('active'));
				popupForms.forEach((popupForm) => popupForm.classList.remove('popup_form--active'));
				e.target.classList.add('active');
				popup.querySelector(e.target.dataset.target).parentNode.classList.add('popup_form--active');
			});
		});
	}

	var dropdownHandlers = document.querySelectorAll('.btn_dropdown');
	var dropdownForms = document.querySelectorAll('.dropdown_form');

	if (dropdownHandlers)
	{
		dropdownHandlers.forEach(btn => {
			btn.addEventListener('click', e => {
				var target = e.target.dataset.target;
				dropdownForms.forEach(form => {
					if (target == form.id)
						form.classList.toggle('dropdown_form--show');
					else
						form.classList.remove('dropdown_form--show');
				});
			});
		});
	}

	var passwordResetForm = document.querySelector('#password_reset_form');

	if (passwordResetForm)
	{
		passwordResetForm.addEventListener('submit', e => {
			e.preventDefault();
			var emailInput = passwordResetForm.querySelector('input[name=email]');
			var email = emailInput.value.trim();

			emailInput.value = "";
			if (email)
			{
				var body = 'email=' + encodeURIComponent(email);

				staff.httpPost('/password/reset', body).then(
					response => {
						popup.classList.remove('connect_popup--show');
						staff.showMessage(response.msg, response.color);
					},
					error => {
						staff.showMessage('ERROR: something with server!', 'danger');
					});
			}
			else
				staff.showMessage('ERROR: Invalid email!', 'danger');
		});
	}

	var verificationRepeatForm = document.querySelector('#verification_form');

	if (verificationRepeatForm)
	{
		verificationRepeatForm.addEventListener('submit', e => {
			e.preventDefault();
			var emailInput = verificationRepeatForm.querySelector('input[name=email]');
			var email = emailInput.value.trim();

			emailInput.value = "";
			if (email)
			{
				var body = 'email=' + encodeURIComponent(email);

				staff.httpPost('/verify/repeat', body).then(
					response => {
						popup.classList.remove('connect_popup--show');
						staff.showMessage(response.msg, response.color);
					},
					error => {
						staff.showMessage('ERROR: something with server!', 'danger');
					});
			}
			else
				staff.showMessage('ERROR: Invalid email!', 'danger');
		});
	}

	var registerForm = document.querySelector('#register_form');

	if (registerForm)
	{
		registerForm.addEventListener('submit', e => {
			e.preventDefault();

			var usernameInput = registerForm.querySelector('input[name=username]');
			var emailInput = registerForm.querySelector('input[name=email]');
			var passwordInput = registerForm.querySelector('input[name=password]');
			var confirmPasswordInput = registerForm.querySelector('input[name=confirm-password]');

			var username = usernameInput.value.trim();
			var email = emailInput.value.trim();
			var password = passwordInput.value.trim();
			var confirmPassword = confirmPasswordInput.value.trim();

			usernameInput.value = "";
			emailInput.value = "";
			passwordInput.value = "";
			confirmPasswordInput.value = "";

			if (username && email && password && confirmPassword)
			{
				var body = 'username=' + encodeURIComponent(username) + '&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password) + '&confirm-password=' + encodeURIComponent(confirmPassword);

				staff.httpPost('/register/index', body).then(
					response => {
						popup.classList.remove('connect_popup--show');
						staff.showMessage(response.msg, response.color);
					},
					error => {
						staff.showMessage('ERROR: something with server!', 'danger');
					});
			}
			else
				staff.showMessage('ERROR: some inputs are missed!', 'danger');
		});
	}
})();