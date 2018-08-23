(() => {
	window.staff = {
		showMessage: (msg, color) => {
			var alertHandler = document.querySelector('.alert');

			alertHandler.children[0].innerHTML = msg;
			alertHandler.classList.add('alert--show');
			alertHandler.classList.add('alert-' + color);
			setTimeout(() => {
				alertHandler.children[0].innerHTML = "";
				alertHandler.classList.remove('alert--show');
				alertHandler.classList.remove('alert-' + color);
			}, 3000);
		},
		httpPost: (url, body) => {
			return new Promise((onSuccess, onError) => {
				var xhr = new XMLHttpRequest();

				xhr.open('POST', url);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

				xhr.onload = (response) => {
				console.log(response.target.responseText);
					response = response.target;
					if (response.status == 200)
						onSuccess(JSON.parse(response.responseText));
					else
						onError(new Error('Connection error'));
				};

				xhr.send(body);
			});
		}
	};
})();