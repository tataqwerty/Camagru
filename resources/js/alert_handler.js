(() => {
	var alertHandler = document.querySelector('.alert');

	if (alertHandler)
	{
		setTimeout(() => {
			alertHandler.classList.add('alert--hide');
		}, 2000);
	}
})();