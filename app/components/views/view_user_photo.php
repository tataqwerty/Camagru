<?php require ROOT . 'components/views/user_header.php'; ?>

<div class="row justify-content-center photos">
	<div class="col-8">
		<div class="row">
			<div class="col">
				<div class="superposable_list">
					<?php foreach($superposables as $fileName): ?>
						<div class="form-check-inline superposable_item disabled">
							<label class="form-check-label">
								<input type="radio" class="form-check-input superposable_radio" name="optradio" value="<?php echo $fileName; ?>">
								<div class="superposable_item_img">
									<img src="<?php echo $fileName; ?>">
								</div>
							</label>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="d-flex flex-row photos_btns">
			<div class="p-2">
				<input type="button" id="camera_btn" class="btn btn-info btn-block" value="Camera" data-target="#video">
			</div>
			<div class="p-2">
				<label id="upload_img" class="btn btn-info btn-block">
					Upload file<input type="file" data-target="#image" hidden>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="embed-responsive embed-responsive-4by3">
					<div id="video">
						<video class="embed-responsive-item" width="640" height="480" autoplay></video>
					</div>
					<div id="image">
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<input type="button" id="snap" class="btn btn-info btn-block" value="Snap photo" disabled>
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