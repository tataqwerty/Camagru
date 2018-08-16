<?php
	if (isset($_SESSION['alertMsg']))
	{
		?>
			<div class="alert alert-<?php echo $_SESSION['alertColor']; ?>" role="alert">
				<strong><?php echo $_SESSION['alertMsg'] ?></strong>
			</div>
		<?php
		unset($_SESSION['alertMsg']);
		unset($_SESSION['alertColor']);
	}
?>