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
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Batch Lists</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Batch Year</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$course = $conn->query("SELECT * FROM batch order by id asc");
								while($row=$course->fetch_assoc()):
								?>
								<tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<?php echo $row['year'] ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_event edit_course" type="button" 
												data-id="<?php echo $row['id'] ?>" 
												data-year="<?php echo $row['year'] ?>" 
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
	$('.edit_batch').click(function(){
		start_load()
		var cat = $('#manage-batch')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='batch']").val($(this).attr('data-year'))
		end_load()
	})
	$('.delete_course').click(function(){
		_conf("Are you sure to delete this course?","delete_course",[$(this).attr('data-id')])
	})
	function delete_course($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_course',
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