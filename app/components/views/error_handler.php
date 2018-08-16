<?php
	if (isset($_SESSION['error']))
	{
		?>
		<div class="alert alert-danger" role="alert">
			<strong>ERROR:</strong> <?php echo $_SESSION['error'] ?>
		</div>
		<?php
		unset($_SESSION['error']);
	}
?>