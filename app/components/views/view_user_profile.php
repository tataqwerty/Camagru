<?php
	/*
	** If user wants to see yourselves page, this header will be displayed.
	*/
	if ($_SESSION['user_logged_in'] == $uid)
		require ROOT . 'components/views/user_header.php';
?>

<div class="row justify-content-center">
	<div class="col">
		<div class="avatar">
			<img src="<?php echo $data['user']['avatar']; ?>">
		</div>
	</div>
	<div class="col">
		<div class="user_info">
			<p>
				Username: <?php echo $data['user']['name']; ?>
			</p>
			<p>
				Email: <?php echo $data['user']['email']; ?>
			</p>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<!-- Section with all photos which user can delete here. -->
</div>