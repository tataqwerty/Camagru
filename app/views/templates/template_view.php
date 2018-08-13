<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		<?php echo $title; ?>
	</title>
	<link rel="stylesheet" href="<?php echo $GLOBALS['style_link']; ?>">
</head>
<body>
	<?php require ROOT . 'app/views/components/header.php'; ?>
	<?php if (isset($sidebar))
		require ROOT . 'app/views/components/sidebar.php';
	?>
	<?php require ROOT . 'app/views/contents/' . $content_view . '.php'; ?>
	<?php require ROOT . 'app/views/components/footer.php'; ?>
</body>
</html>