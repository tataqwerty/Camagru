(() => {
	var verificationHandler = document.querySelector('.btn_verification');
	var dropdownForm = document.querySelector('.dropdown_form');

	if (verificationHandler)
	{
		verificationHandler.addEventListener('click', () => {
			dropdownForm.classList.toggle('dropdown_form--show');
		});
	}
})()