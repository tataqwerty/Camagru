<div class="header container-fluid">
	<div class="row">
		<div class="col-2">
			<div class="logo">
				<h4>
					Camagru
				</h4>
			</div>
		</div>
		<div class="col">

			<?php echo $menu; ?>



			<?php foreach($nav as $item): ?>
				<li class="col-auto">
					<a href="<?php echo $item['link']; ?>" class="btn">
						<?php echo $item['content']; ?>
					</a>
				</li>
			<?php endforeach; ?>

			</ul>
		</div>
	</div>
</div>