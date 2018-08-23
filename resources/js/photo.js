(() => {
	var srcObject = document.querySelector('.src_object');
	var uploadImgHandler = document.querySelector('#upload_btn');
	var cameraHandler = document.querySelector('#camera_btn');
	var snapHandler = document.querySelector('#snap');
	var superposables = document.querySelector('.superposable_list');
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	var superposableImg;

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
			superposableImg = superposables.querySelector(`img#${e.target.value}`);

			if (srcObject.querySelector('.src') != undefined)
				snapHandler.disabled = false;
		}
	});

	function convertToBase64(elem) {
		ctx.drawImage(elem, 0, 0, 0, 0);
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

	snapHandler.addEventListener('click', () => {
		var mainImage = convertToBase64(srcObject.querySelector('.src'));
		var segmentedMainImage = mainImage.split(';');
		var mainImage_contentType = segmentedMainImage[0].split(':')[1];
		var mainImage_base64 = segmentedMainImage[1].split(',')[1];

		var mainImage_blob = b64toBlob(mainImage_base64, mainImage_contentType);

		var superposableImage = convertToBase64(superposableImg);
		var segmentedSuperposableImage = superposableImage.split(';');
		var superposableImage_contentType = segmentedSuperposableImage[0].split(':')[1];
		var superposableImage_base64 = segmentedSuperposableImage[1].split(',')[1];

		var superposableImage_blob = b64toBlob(superposableImage_base64, superposableImage_contentType);

		var formData = new FormData();

		formData.append("main", mainImage_blob);
		formData.append("superposable", superposableImage_blob);


		$.ajax({
			url:"/profile/photo/merge",
			data: formData,
			type:"POST",
			contentType:false,
			processData:false,
			complete:function(response){
				console.log(response.responseText);
			}
		});

		// var xhr = new XMLHttpRequest();

		// xhr.open('POST', '/profile/photo/merge');


		// xhr.onload = (response) => {
		// 	console.log(response.target.responseText);
		// };

		// xhr.send(formData);
	});
})();