<div class="alert" role="alert">
	<strong></strong>
</div>
<?php if (isset($_SESSION['alert'])):
		$message = $_SESSION['alert']['msg'];
		$color = $_SESSION['alert']['color'];
		unset($_SESSION['alert']);
?>
	<script>
		(() => {
			var alertHandler = document.querySelector('.alert');

			alertHandler.children[0].innerHTML = "<?php echo $message; ?>";
			alertHandler.classList.add('alert--show');
			alertHandler.classList.add('alert-' + "<?php echo $color; ?>");
			setTimeout(() => {
				alertHandler.children[0].innerHTML = "";
				alertHandler.classList.remove('alert--show');
				alertHandler.classList.remove('alert-' + "<?php echo $color; ?>");
			}, 3000);
		})();
	</script>
<?php endif; ?>