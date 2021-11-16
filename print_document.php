<!DOCTYPE html>
<html lang="en">
<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM parcels where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
if($to_branch_id > 0 || $from_branch_id > 0){
	$to_branch_id = $to_branch_id  > 0 ? $to_branch_id  : '-1';
	$from_branch_id = $from_branch_id  > 0 ? $from_branch_id  : '-1';
$branch = array();
 $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id in ($to_branch_id,$from_branch_id)");
    while($row = $branches->fetch_assoc()):
    	$branch[$row['id']] = $row['address'];
	endwhile;
}
ob_start();
getSystem($conn);
ob_end_flush();

include 'header.php' 
?>
<body>
<div class="container-fluid" id="printViewDoc">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="callout callout-info">
					<div class="row">
						<div class="col-md-6">
							<dl>
								<dt>Tracking Number:</dt>
								<dd> <h4 class="barcode"><?php echo $reference_number ?></h4></dd>
								<dd> <h4><b><?php echo $reference_number ?></b></h4></dd>
							</dl>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-success float-right" id="print"><i class="fa fa-print"></i> Print</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Sender Information</b>
					<dl>
						<dt>Name:</dt>
						<dd><?php echo ucwords($sender_name) ?></dd>
						<dt>Station / School:</dt>
						<dd><?php echo ucwords($station_school) ?></dd>
						<dt>Station Address:</dt>
						<dd><?php echo ucwords($station_address) ?></dd>
						<dt>District</dt>
						<dd><?php echo ucwords($sender_dis) ?></dd>
					</dl>
				</div>
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Recipient Information</b>
					<dl>
						<dt>Name of Office:</dt>
						<dd><?php echo ucwords($office_name) ?></dd>
						<dt></dt>
						<dd><?php echo ucwords($other_sp) ?></dd>
						<dt>Person In Charge:</dt>
						<dd><?php echo ucwords($pic) ?></dd>
					</dl>
				</div>
			</div>
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Document Details</b>
					<dl>
						<dt>Description:</dt>
						<dd><?php echo $description ?></dd>
					</dl>	
					<!--<dl>
						<dt>Type:</dt>
						<dd><?php echo $type == 1 ? "<span class='badge badge-primary'>Deliver to Recipient</span>":"<span class='badge badge-info'>Pickup</span>" ?></dd>
					</dl>	-->
					<dl>
						<!--<dt>Office Accepted the Document:</dt>
						<dd><?php echo ucwords($branch[$from_branch_id]) ?></dd>
						<?php if($type == 2): ?>
							<dt>Nearest Office to Recipient for Pickup:</dt>
							<dd><?php echo ucwords($branch[$to_branch_id]) ?></dd>
						<?php endif; ?> -->
						<dt>Status:</dt>
						<dd>
							<?php 
							switch ($status) {
								case '1':
									echo "<span class='badge badge-pill badge-info'> Collected</span>";
									break;
								case '2':
									echo "<span class='badge badge-pill badge-info'> Shipped</span>";
									break;
								case '3':
									echo "<span class='badge badge-pill badge-primary'> In-Transit</span>";
									break;
								case '4':
									echo "<span class='badge badge-pill badge-primary'> Arrived At Destination</span>";
									break;
								case '5':
									echo "<span class='badge badge-pill badge-primary'> Out for Delivery</span>";
									break;
								case '6':
									echo "<span class='badge badge-pill badge-primary'> Ready to Pickup</span>";
									break;
								case '7':
									echo "<span class='badge badge-pill badge-success'>Delivered</span>";
									break;
								case '8':
									echo "<span class='badge badge-pill badge-success'> Picked-up</span>";
									break;
								case '9':
									echo "<span class='badge badge-pill badge-danger'> Unsuccessfull Delivery Attempt</span>";
									break;
								
								default:
									echo "<span class='badge badge-pill badge-info'> Tracking Number Generated</span>";
									
									break;
							}

							?>
							
						</dd>

					</dl>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<noscript>
	<style>
		table.table{
			width:100%;
			border-collapse: collapse;
		}
		table.table tr,table.table th, table.table td{
			border:1px solid;
		}
		.text-cnter{
			text-align: center;
		}
	</style>
	<h3 class="text-center"><b>Student Result</b></h3>
</noscript>
<script>
	$('#update_status').click(function(){
		uni_modal("Update Status of: <?php echo $reference_number ?>","manage_parcel_status.php?id=<?php echo $id ?>&cs=<?php echo $status ?>","")
	})
	$('#print').click(function(){
		$(this).hide();
		window.print();
		$(this).show();
		
	})
</script>

	
</body>
</html>