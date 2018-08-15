(() => {
var connectBtn = document.querySelector('.connect_btn');
var closeBtn = document.querySelector('.popup_close_btn');
var popup = document.querySelector('.connect_popup');
var popupBtns = document.querySelectorAll('.popup_btn');
var popupForms = document.querySelectorAll('.popup_form');

connectBtn.addEventListener('click', (e) => {
		popup.style.display = 'block';
});

closeBtn.addEventListener('click', (e) => {
	popup.style.display = 'none';
});

popupBtns.forEach((popupBtn) => {
	popupBtn.addEventListener('click', (e) => {
		popupBtns.forEach((popupBtn) => popupBtn.classList.remove('active'));
		popupForms.forEach((popupForm) => popupForm.style.display = 'none');
		e.target.classList.add('active');
		popup.querySelector(e.target.dataset.target).style.display = 'block';
	});
});
})();