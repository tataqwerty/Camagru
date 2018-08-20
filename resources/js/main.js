(() => {
	var alertHandler = document.querySelector('.alert');

	if (alertHandler)
	{
		setTimeout(() => {
			alertHandler.classList.add('alert--hide');
		}, 2000);
	}

	var connectBtn = document.querySelector('.connect_btn');
	var popup = document.querySelector('.connect_popup');
	var closeBtn = popup.querySelector('.popup_close_btn');
	var popupBtns = document.querySelectorAll('.popup_btn');
	var popupForms = document.querySelectorAll('.popup_form');

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
})();