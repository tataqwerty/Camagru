(() => {
	var connectBtn = document.querySelector('.connect_btn');
	var closeBtn = document.querySelector('.popup_close_btn');
	var popup = document.querySelector('.connect_popup');
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
			popup.querySelector(e.target.dataset.target).classList.add('popup_form--active');
		});
	});
})();