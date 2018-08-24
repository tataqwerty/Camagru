(() => {
	var srcObject = document.querySelector('.src_object');
	var uploadImgHandler = document.querySelector('#upload_btn');
	var cameraHandler = document.querySelector('#camera_btn');
	var snapHandler = document.querySelector('#snap');
	var superposables = document.querySelector('.superposable_list');
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	var superposableImg;
	var sidebar = document.querySelector('.sidebar');
	var saveAvatarHandler = document.querySelector('.save_avatar');
	var saveImageHandler = document.querySelector('.save_photo');

	uploadImgHandler.addEventListener('change', () => {
		var extensions = ['jpg', 'jpeg'];
		var fileExt = null;

		if (uploadImgHandler.files.length > 0)
		{
			var file = uploadImgHandler.files[0];

			uploadImgHandler.value = null;

			extensions.forEach(ext => {
				if (file.type.indexOf(ext) != -1)
					fileExt = ext;
			});
			if (!fileExt)
			{
				staff.showMessage('ERROR: Invalid file extension!', 'danger');
				return ;
			}

			if (!window.File || !window.FileReader || !window.FileList)
			{
				staff.showMessage('The File APIs are not fully supported in this browser.', 'danger');
				return ;
			}

			var reader = new FileReader();

			reader.onload = (file) => {
				srcObject.innerHTML = `<img class="src" src="${file.target.result}">`;
				
				if (superposableImg != undefined)
					snapHandler.disabled = false;
			};

			reader.readAsDataURL(file);
		}
	});

	if (navigator.mediaDevices != undefined && navigator.mediaDevices.getUserMedia != undefined)
	{
		cameraHandler.addEventListener('click', () => {
			navigator.mediaDevices.getUserMedia({video: true}).then(
				stream => {

				srcObject.innerHTML = `
					<div class="embed-responsive embed-responsive-4by3">
						<video class="embed-responsive-item src" width="640" height="480" autoplay></video>
					</div>`;

					var video = srcObject.querySelector('.src');
					var canvas = document.querySelector('#canvas');
					var ctx = canvas.getContext('2d');

					video.srcObject = stream;
					video.play();

					if (superposableImg != undefined)
						snapHandler.disabled = false;
				},
				error => {
					staff.showMessage('ERROR: something with your camera!', 'danger');
				});
		});
	}
	else
		cameraHandler.disabled = true;

	superposables.addEventListener('click', e => {
		if (e.target.classList.contains('superposable_radio'))
		{
			superposableImg = superposables.querySelector(`img#${e.target.value}`).src;

			if (srcObject.querySelector('.src') != undefined)
				snapHandler.disabled = false;
		}
	});

	function convertToBase64(elem) {
		ctx.drawImage(elem, 0, 0, 640, 480);
		return canvas.toDataURL();
	}

	function b64toBlob(b64Data, contentType, sliceSize) {
		contentType = contentType || '';
		sliceSize = sliceSize || 512;

		var byteCharacters = atob(b64Data);
		var byteArrays = [];

		for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
			var slice = byteCharacters.slice(offset, offset + sliceSize);

			var byteNumbers = new Array(slice.length);
			for (var i = 0; i < slice.length; i++) {
				byteNumbers[i] = slice.charCodeAt(i);
			}

			var byteArray = new Uint8Array(byteNumbers);

			byteArrays.push(byteArray);
		}

		var blob = new Blob(byteArrays, {type: contentType});
		return blob;
	}

	function showSidebar() {
		sidebar.innerHTML = '';
		staff.httpGet('/profile/photo/sidebar').then(
			response => {
				response.forEach((elem) => {
					sidebar.innerHTML += `<div class="p-2 sidebar_elem"><img src="${elem}"></div>`;
				});
			},
			error => {
				console.log(error);
			});
	}

	snapHandler.addEventListener('click', () => {
		var image = convertToBase64(srcObject.querySelector('.src'));
		var segmentedImage = image.split(';');
		var image_contentType = segmentedImage[0].split(':')[1];
		var image_base64 = segmentedImage[1].split(',')[1];

		var image_blob = b64toBlob(image_base64, image_contentType);

		var formData = new FormData();

		formData.append("main", image_blob);
		formData.append("superposable", superposableImg);

		var xhr = new XMLHttpRequest();

		xhr.open('POST', '/profile/photo/merge');

		xhr.onload = (response) => {
			document.querySelector('#img_show').src = JSON.parse(response.target.response).image;
			showSidebar();
		};

		xhr.send(formData);
	});

	saveAvatarHandler.addEventListener('click', () => {
		var image = document.querySelector('#choosed');

		if (image)
		{
			image = image.src;

			var body = `image=${image}&avatar=1`;

			staff.httpPost(`/profile/photo/save`, body).then(
				response => {
					console.log(response);
				},
				error => {
					console.log(error);
				});
		}
	});
	saveImageHandler.addEventListener('click', () => {
		var image = document.querySelector('#choosed');

		if (image)
		{
			image = image.src;

			var body = `image=${image}&avatar=0`;

			staff.httpPost(`/profile/photo/save`, body).then(
				response => {
					console.log(response);
				},
				error => {
					console.log(error);
				});
		}
	});

	sidebar.addEventListener('click', e => {
		console.log(e.target);
		if (e.target.classList.contains('sidebar_elem'))
		{
			document.querySelectorAll('.sidebar_elem img').forEach(elem => elem.id = '');
			e.target.querySelector('img').id = 'choosed';
			saveImageHandler.classList.add('save_image--show');
			saveAvatarHandler.classList.add('save_avatar--show');
		}
	});

	showSidebar();
})();