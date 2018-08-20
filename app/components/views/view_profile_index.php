<div class="row justify-content-center">
	<div class="col">
		<div class="avatar">
			<img src="<?php echo $data['user']['avatar']; ?>">
		</div>
	</div>
	<div class="col">
		<div class="user_info">
			<p>
				Username: <?php echo $data['user']['username']; ?>
			</p>
			<p>
				Email: <?php echo $data['user']['email']; ?>
			</p>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col">
		<button class="btn btn_info">
			Profile
		</button>
		<button class="btn btn_info">
			Settings
		</button>
		<button class="btn btn_info">
			Make a photo
		</button>
	</div>
</div>
<div class="row justify-content-center">
	<!-- Section with all photos which user can delete here. -->
</div>