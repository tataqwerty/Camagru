<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title; ?></title>
	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Custom styles -->
	<link rel="stylesheet" href="/resources/styles/style.css">

	<!-- Add some javascript -->
	<script src="/resources/js/main.js"></script>
</head>
<body>
	<?php require ROOT . 'components/views/header.php'; ?>

	<!-- Main content -->
	<div class="container">
		<?php require ROOT . 'components/views/' . $contentView . '.php'; ?>
	</div>

	<?php require ROOT . 'components/views/footer.php'; ?>

	<?php require ROOT . 'components/views/connect_popup.php'; ?>

	<?php require ROOT . 'components/views/alert.php'; ?>
</body>
</html>