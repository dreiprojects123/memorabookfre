	<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-12 col-lg-12 col-md-8">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-6" id="uploadFormPanel" style="display: none;">
			<form action="" id="manage-gallery" enctype="multipart/form-data">
				<div class="card">
				<div class="card-header">
					Upload
				</div>
				<div class="card-body">
					<input type="hidden" name="id">

					<!-- Image Upload -->
					<div class="form-group">
					<label class="control-label">Image</label>
					<input type="file" class="form-control" name="img" onchange="displayImg(this, $(this))">
					</div>

					<div class="form-group text-center">
					<img src="#" alt="Preview" id="cimg" class="img-fluid img-thumbnail" style="max-height: 200px; display: none;">
					</div>

					<!-- Event Name -->
					<div class="form-group">
						<label class="control-label">Event Name</label>
						<select class="form-control" name="event_name">
							<option disabled selected>Select an event</option>
							<option value="Field Trip">Field Trip</option>
							<option value="Retreat">Retreat</option>
							<option value="Educational Tour">Educational Tour</option>
							<option value="Graduation">Graduation</option>
							<option value="Recognition">Recognition</option>
							<option value="Intrams">Intrams</option>
							<option value="Foundation Week">Foundation Week</option>
							<option value="Graduation Ball">Graduation Ball</option>
							<option value="Others">Others</option>
						</select>
					</div>

					<!-- Image Title -->
					<div class="form-group">
					<label class="control-label">Title</label>
					<input type="text" class="form-control" name="title" placeholder="Optional title">
					</div>

					<!-- Image Caption -->
					<div class="form-group">
					<label class="control-label">Caption</label>
					<textarea class="form-control" name="caption" rows="2" placeholder="Optional caption"></textarea>
					</div>

					<!-- Contributor Name -->
					<div class="form-group">
					<label class="control-label">Contributor</label>
					<input type="text" class="form-control" name="contributor" placeholder="Your name (admin)">
					</div>

					<!-- Short Description -->
					<div class="form-group">
					<label class="control-label">Short Description</label>
					<textarea class="form-control" name="about" rows="3"></textarea>
					</div>

					<!-- Batch Select -->
					<div class="form-group">
					<label class="control-label">Batch</label>
					<select class="form-control" name="batch_id" required>
						<option value="" disabled selected>Select batch</option>
						<?php
						$batch = $conn->query("SELECT id, year FROM batch ORDER BY year DESC");
						while ($row = $batch->fetch_assoc()):
						?>
						<option value="<?php echo $row['id']; ?>">
							Batch <?php echo $row['year']; ?>
						</option>
						<?php endwhile; ?>
					</select>
					</div>
				</div>

				<!-- Buttons -->
				<div class="card-footer">
					<div class="row">
					<div class="col-md-12">
						<button class="btn btn-sm btn-primary col-sm-3 offset-md-3">Save</button>
						<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-gallery').get(0).reset()">Cancel</button>
					</div>
					</div>
				</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->


			<!-- Table Panel -->
			<div class="col-12 gallerylist">
				<div class="mb-2 text-right">
					<button id="toggleUploadForm" class="btn btn-success btn-sm">
						<i class="fas fa-upload"></i> Upload Image
					</button>
				</div>
			<div class="card">
				<div class="card-header">
				<b>Gallery List</b>
				</div>
				<div class="card-body">
				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">IMG</th>
						<th class="text-center">Event</th>
						<th class="text-center">Title</th>
						<th class="text-center">Caption</th>
						<th class="text-center">Description</th>
						<th class="text-center">Contributor</th>
						<th class="text-center">Batch</th>
						<th class="text-center">Action</th>
					</tr>
					</thead>
					<tbody>
					<?php 
					$i = 1;
					$img = array();
					$fpath = 'assets/uploads/gallery';
					$files= is_dir($fpath) ? scandir($fpath) : array();
					foreach($files as $val){
						if(!in_array($val, array('.','..'))){
						$n = explode('_',$val);
						$img[$n[0]] = $val;
						}
					}

					$gallery = $conn->query("
						SELECT g.*, b.year as batch_year 
						FROM gallery g 
						INNER JOIN batch b ON g.batch_id = b.id 
						ORDER BY g.id ASC
					");
					while($row = $gallery->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
						<img src="<?php echo isset($img[$row['id']]) && is_file($fpath.'/'.$img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : '' ?>" class="gimg" alt="" style="max-width: 100px;">
						</td>
						<td><?php echo $row['event_name'] ?></td>
						<td><?php echo $row['title'] ?></td>
						<td><?php echo $row['caption'] ?></td>
						<td><?php echo $row['about'] ?></td>
						<td><?php echo $row['contributor'] ?></td>
						<td><?php echo $row['batch_year'] ?></td>
						<td class="text-center">
						<button class="btn btn-sm btn-outline-primary edit_gallery d-inline-block" type="button"
							data-id="<?php echo $row['id'] ?>"
							data-event_name="<?php echo htmlspecialchars($row['event_name'], ENT_QUOTES) ?>"
							data-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES) ?>"
							data-caption="<?php echo htmlspecialchars($row['caption'], ENT_QUOTES) ?>"
							data-about="<?php echo htmlspecialchars($row['about'], ENT_QUOTES) ?>"
							data-contributor="<?php echo htmlspecialchars($row['contributor'], ENT_QUOTES) ?>"
							data-batch_id="<?php echo $row['batch_id'] ?>"
							data-src="<?php echo isset($img[$row['id']]) && is_file($fpath.'/'.$img[$row['id']]) ? $fpath.'/'.$img[$row['id']] : '' ?>"
							title="Edit">
							<i class="fas fa-edit"></i>
						</button>
						<button class="btn btn-sm btn-outline-danger delete_gallery d-inline-block" type="button"
							data-id="<?php echo $row['id'] ?>"
							title="Delete">
							<i class="fas fa-trash"></i>
						</button>
						</td>
					</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
				</div>
			</div>
			</div>
			<!-- Table Panel -->

		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	img#cimg{
		max-height: 23vh;
		max-width: calc(100%);
	}
	.gimg{
		max-height: 15vh;
		max-width: 10vw;
	}

</style>
<script>
	document.getElementById('toggleUploadForm').addEventListener('click', function () {
        const formPanel = document.getElementById('uploadFormPanel');
        const cimg = document.getElementById('cimg');
        if (formPanel.style.display === 'none' || formPanel.style.display === '') {
            formPanel.style.display = 'block';
            this.innerHTML = '<i class="fas fa-times"></i> Cancel Upload';
            this.classList.remove('btn-success');
            this.classList.add('btn-secondary');
        } else {
            formPanel.style.display = 'none';
            this.innerHTML = '<i class="fas fa-upload"></i> Upload Image';
            this.classList.remove('btn-secondary');
            this.classList.add('btn-success');
            document.getElementById('manage-gallery').reset();
            if (cimg) cimg.style.display = 'none';
        }
    });

    // Optional: Auto show preview
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
	function displayImg(input,_this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage-gallery').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_gallery',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$(document).on('click', '.edit_gallery', function() {
		// Get data attributes from button
		var id = $(this).data('id');
		var about = $(this).data('about');
		var batch_id = $(this).data('batch_id');  // Note: your data attribute is 'data-batch_year'
		var src = $(this).data('src');
		var event_name = $(this).data('event_name') || '';
		var title = $(this).data('title') || '';
		var caption = $(this).data('caption') || '';
		var contributor = $(this).data('contributor') || '';

		// Show the upload form panel if hidden
		$('#uploadFormPanel').show();
		$('#toggleUploadForm').html('<i class="fas fa-times"></i> Cancel Upload').removeClass('btn-success').addClass('btn-secondary');

		// Populate the form fields with existing data
		$('#manage-gallery [name="id"]').val(id);
		$('#manage-gallery [name="about"]').val(about);
		$('#manage-gallery [name="batch_id"]').val(batch_id);
		$('#manage-gallery [name="event_name"]').val(event_name);
		$('#manage-gallery [name="title"]').val(title);
		$('#manage-gallery [name="caption"]').val(caption);
		$('#manage-gallery [name="contributor"]').val(contributor);

		// Show current image preview if available
		if(src) {
			$('#cimg').attr('src', src).show();
		} else {
			$('#cimg').hide();
		}
	});

	$('.delete_gallery').click(function(){
		_conf("Are you sure to delete this data?","delete_gallery",[$(this).attr('data-id')])
	})
	function delete_gallery($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_gallery',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>