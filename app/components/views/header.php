<div class="header container-fluid">
	<div class="row">
		<div class="col-auto">
			<div class="logo">
				<h4>
					Camagru
				</h4>
			</div>
		</div>
		<div class="col">

		<ul class="menu d-flex justify-content-end">
			<?php foreach($menu as $link => $page): ?>
				<li class="menu_item">
					<a href="<?php echo $link; ?>" class="btn <?php echo ($link == $currentLink) ? 'btn-info' : 'btn-secondary'; ?>">
						<?php echo $page; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		</div>
	</div>
</div>