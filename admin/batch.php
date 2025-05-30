<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
		
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-batch" enctype="multipart/form-data">
				<div class="card">
				<div class="card-header">
					<b>Add/Create Batch</b>
				</div>
				<div class="card-body">
					<input type="hidden" name="id">

					<!-- Year Input -->
					<div class="form-group">
					<label class="control-label">Batch Year:</label>
					<input type="text" class="form-control datepicker" name="batch" placeholder="Select Year">
					</div>

					<!-- Image Upload Input -->
					<div class="form-group">
					<label class="control-label">Batch Cover Image:</label>
					<input type="file" class="form-control" name="img" accept="image/*" onchange="displayImg(this, $(this))">
					</div>

					<!-- Preview -->
					<div class="form-group text-center">
					<img id="cimg" src="#" alt="Preview" class="img-fluid img-thumbnail" style="max-height: 200px; display: none;">
					</div>
				</div>

				<div class="card-footer">
					<div class="row">
					<div class="col-md-12 text-center">
						<button class="btn btn-sm btn-primary col-sm-4">Save</button>
						<button class="btn btn-sm btn-secondary col-sm-4" type="button" onclick="$('#manage-batch').get(0).reset()">Cancel</button>
					</div>
					</div>
				</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Batch Lists</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead class="thead-light">
								<tr class="text-center">
									<th>#</th>
									<th>Cover</th>
									<th>Batch Year</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$batch = $conn->query("SELECT * FROM batch ORDER BY id ASC");
								while($row = $batch->fetch_assoc()):
									$cover = !empty($row['img']) && file_exists('assets/uploads/batch/'.$row['img']) 
										? 'assets/uploads/batch/'.$row['img'] 
										: 'assets/uploads/no-image.png'; // fallback image
								?>
								<tr class="text-center align-middle">
									<td><?php echo $i++ ?></td>
									<td>
										<img src="<?php echo $cover ?>" alt="cover" style="height:60px; width:auto; object-fit:cover;" class="img-thumbnail">
									</td>
									<td><?php echo $row['year'] ?></td>
									<td>
										<button class="btn btn-sm btn-outline-primary edit_event edit_batch" type="button" 
											data-id="<?php echo $row['id'] ?>" 
											data-year="<?php echo $row['year'] ?>" 
											data-img="<?php echo htmlspecialchars($row['img'], ENT_QUOTES) ?>" 
											title="Edit">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn btn-sm btn-outline-danger delete_course" type="button" 
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

			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
			$('#cimg').attr('src', e.target.result).show();
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
    $('.datepicker').datepicker({
        format: " yyyy", 
        viewMode: "years", 
        minViewMode: "years"
    })

	
	$('#manage-batch').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_batch',
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
	// Edit batch button click
	$('.edit_batch').click(function() {
		start_load();
		var form = $('#manage-batch');
		form.get(0).reset();

		form.find("[name='id']").val($(this).attr('data-id'));
		form.find("[name='batch']").val($(this).attr('data-year'));

		// Optional: load image preview if editing cover
		var img = $(this).attr('data-img');
		if (img) {
			$('#cimg').attr('src', 'assets/uploads/batch/' + img).show();
		}

		end_load();
	});
	$('.delete_batch').click(function(){
		_conf("Are you sure to delete this batch?","delete_batch",[$(this).attr('data-id')])
	})
	function delete_batch($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_batch',
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