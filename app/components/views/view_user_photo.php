<?php require ROOT . 'components/views/user_header.php'; ?>

<div class="row justify-content-center photos">
	<div class="col-8">
		<div class="row">
			<div class="col">
				<ul class="superposable_list">
					<?php foreach($superposables as $src): ?>
						<li class="superposable_item">
							<img src="<?php echo $src; ?>" class="superposable_item_img">
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="embed-responsive embed-responsive-4by3">
					<video id="video" class="embed-responsive-item" width="640" height="480" autoplay></video>
				</div>
			</div>
		</div>
		<div class="d-flex flex-row photos_btns">
			<div class="p-2">
				<input id="snap" class="btn btn-info btn-block" value="Snap photo">
			</div>
			<div class="p-2">
				<label id="upload_img" class="btn btn-info btn-block">
					Upload file<input type="file" hidden>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<canvas id="canvas" width="640" height="480"></canvas>
			</div>
		</div>
	</div>
	<div class="col-4 sidebar">

	</div>
</div>
<script src="/resources/js/photo.js"></script>