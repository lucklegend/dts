<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_document"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body onScroll-x">
			<table class="table tabe-hover table-bordered" id="list">
				<!-- <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Reference Number</th>
						<th>Sender Name</th>
						<th>Office Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$i = 1;
					$where = "";
					if(isset($_GET['s'])){
						$where = " where status = {$_GET['s']} ";
					}
					if($_SESSION['login_type'] == 3){
						if($where == ''){
							$where .= " WHERE created_by = ".$_SESSION['login_id']." ";
						}else{
							$where .= " AND created_by = ".$_SESSION['login_id']." ";
						}
						
					}
					
					$qry = $conn->query("SELECT * from parcels $where order by  unix_timestamp(date_created) desc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td><b><?php echo ($row['reference_number']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_name']) ?></b></td>
						<td><b><?php echo ucwords($row['office_name']) ?>  <?php echo ucwords($row['other_sp']) ?></b></td>
						<td class="text-center">
							<?php 
							switch ($row['status']) {
								case '1':
									echo "<span class='badge badge-pill badge-info'> Collected</span>";
									break;
								case '2':
									echo "<span class='badge badge-pill badge-info'> Action Taken</span>";
									break;
								case '3':
									echo "<span class='badge badge-pill badge-primary'> Pending</span>";
									break;
								case '4':
									echo "<span class='badge badge-pill badge-primary'> Lacking Documents</span>";
									break;
								case '5':
									echo "<span class='badge badge-pill badge-primary'> Picked Up</span>";
									break;
							
							
								default:
									echo "<span class='badge badge-pill badge-info'> Tracking Number Generated</span>";
									
									break;
							}

							?>
						</td>
						<td class="text-center">
		                    <div class="btn-group">
		                    	<button type="button" class="btn btn-info btn-flat view_parcel" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-eye"></i>
		                        </button>
		                        <a href="index.php?page=edit_document&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat ">
		                          <i class="fas fa-edit"></i>
		                        </a>
								<?php if($_SESSION['login_type'] == 1 OR $_SESSION['login_type'] == 2):  ?>
		                        <button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button> <?php endif; ?>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table td{
		vertical-align: middle !important;
	}
</style>
<script>
	$(document).ready(function(){
		<?php if(isset($_GET['id'])): ?>
			uni_modal("Document's Details","view_document.php?id="+<?php echo $_GET['id'];?>,"large")
		<?php endif; ?>
		$('#list').dataTable()
		$('.view_parcel').click(function(){
			uni_modal("Document's Details","view_document.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_parcel').click(function(){
	_conf("Are you sure to delete this Document?","delete_parcel",[$(this).attr('data-id')])
	})
	})
	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_parcel',
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
</script>