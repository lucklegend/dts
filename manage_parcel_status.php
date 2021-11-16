<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="update_status">
		<input type="show" name="id" value="<?php echo $_GET['id'] ?>">
		<input type="show" name="created_by" value="<?php echo $_SESSION['login_type'] ?>">
		<input type="show" name="modified_by" value="<?php echo $_SESSION['login_name'] ?>"> 
		<div class="form-group">
			<label for="">Update Status</label>
			<?php $status_arr = array("Tracking Number Generated","Collected","Action Taken","Pending","Lacking Documents","Picked Up"); ?>
			<select name="status" id="" class="custom-select custom-select-sm">
				<?php foreach($status_arr as $k => $v): ?>
					<option value="<?php echo $k ?>" <?php echo $_GET['cs'] == $k ? "selected" :'' ?>><?php echo $v; ?></option>
				<?php endforeach; ?>
			</select>
			
		</div>
	</form>
</div>

<div class="modal-footer display p-0 m-0">
        <button class="btn btn-primary" form="update_status">Update</button>
        <button type="button" class="btn btn-secondary" onclick="uni_modal('Document\'s Details','view_document.php?id=<?php echo $_GET['id'] ?>','large')">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<script>
	$('#update_status').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=update_parcel',
			method:'POST',
			data:$(this).serialize(),
			error:(err)=>{
				console.log(err)
				alert_toast('An error occured.',"error")
				end_load()
			},
			success:function(resp){
				if(resp==1){
					alert_toast("Document's Status successfully updated",'success');
					setTimeout(function(){
						location.reload()
					},750)
				}
			}
		})
	})
</script>