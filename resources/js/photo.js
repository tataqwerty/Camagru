(() => {
	if (navigator.mediaDevices != undefined && navigator.mediaDevices.getUserMedia != undefined)
	{
		navigator.mediaDevices.getUserMedia({video: true}).then(
			stream => {
				var video = document.querySelector('#video.video');
				var photoHandler = document.querySelector('#snap');
				var canvas = document.querySelector('#canvas');
				var ctx = canvas.getContext('2d');

				video.srcObject = stream;
				video.play();

				photoHandler.addEventListener('click', () => {
					ctx.drawImage(video, 0, 0, 640, 480);
				});
			},
			error => {
				staff.showMessage('ERROR: something with your fucking camera!', 'danger');
			});
	}

	var uploadImgHandler = document.querySelector('#upload_img input[type=file]');

	uploadImgHandler.addEventListener('change', () => {
		var extensions = ['jpg', 'jpeg'];
		var fileExt = null;

		if (uploadImgHandler.files.length > 0)
		{
			var file = uploadImgHandler.files[0];

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
				console.log(file);
				// var canvas = document.querySelector('#canvas');
				// var ctx = canvas.getContext('2d');

				// ctx.drawImage(file.target.result, 0, 0, 100, 100);
			};

			reader.readAsDataURL(file);
		}
	});

	var cameraHandler = document.querySelector('#camera_btn');

	cameraHandler.addEventListener('click', () => {
		
	});


	var snapHandler = document.querySelector('#snap');

	snapHandler.addEventListener('click', () => {

	});

	var superposables = document.querySelector('.superposable_list');

	superposables.addEventListener('click', e => {
		if (e.target.classList.contains('superposable_radio'))
		{
			snapHandler.disabled = false;
		}
	});
})();