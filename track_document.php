<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  getSystem($conn);
  ob_end_flush();
 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

	include 'header.php' 
?>
<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed" style="background-color: #C6E9F9">
	<div class="wrapper">
		<div class="row">
			<nav class="navbar navbar-expand navbar-light bg-light " id="track_docs_header">
			    <!-- Left navbar links -->
			    <img src="./assets/images/logo.png" alt="logo" class="img-circle" id="brand-logo">
			    <ul class="navbar-nav">
			      <li>
			        <a class="nav-link text-gray"  href="./" role="button"> <large><b><?php echo $_SESSION['system']['name'] ?></b></large></a>
			      </li>
			    </ul>

			    <ul class="navbar-nav ml-auto">
			      	<li class="nav-item">
			        	<a class="nav-link" data-widget="fullscreen" href="#" role="button" id="fullscreenBtn">
			          		<i class="fas fa-expand-arrows-alt"></i>
			        	</a>
			      	</li>
			     	<li class="nav-item dropdown">
		            	<a class="nav-link"  href="./login.php" id="loginText">
		              		<span>
			                	<div class="d-felx badge-pill">
			                  		<span class="fa fa-user mr-2"></span>
			                  		<span class="login-text"><b>Login</b></span>
			                	</div>
		              		</span>
		            	</a>
			      	</li>
			    </ul>
			</nav>
			<!-- /.navbar -->
		</div>
		<div class="spacer"></div>
		<div class="spacer"></div>
		<div class="col-lg-12">
			<div class="card card-outline card-primary">
				<div class="card-body">
					<div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
						<label for="">Enter Tracking Number</label>
						<div class="input-group col-sm-5">
		                    <input type="search" id="ref_no" class="form-control form-control-sm" placeholder="Type the tracking number here">
		                    <div class="input-group-append">
		                        <button type="button" id="track-btn" class="btn btn-sm btn-primary btn-gradient-primary">
		                            <i class="fa fa-search"></i>
		                        </button>
		                    </div>
		                </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="timeline" id="parcel_history">
						
					</div>
				</div>
			</div>
		</div>
		<div id="clone_timeline-item" class="d-none">
			<div class="iitem">
			    <i class="fas fa-box bg-blue"></i>
			    <div class="timeline-item">
			      <span class="time"><i class="fas fa-clock"></i> <span class="dtime">12:05</span></span>
			      <div class="timeline-body">
			      	asdasd
			      </div>
			    </div>
			  </div>
		</div>
		<script>
			function track_now(){
				start_load()
				var tracking_num = $('#ref_no').val()
				if(tracking_num == ''){
					$('#parcel_history').html('')
					end_load()
				}else{
					$.ajax({
						url:'ajax.php?action=get_parcel_heistory',
						method:'POST',
						data:{ref_no:tracking_num},
						error:err=>{
							console.log(err)
							alert_toast("An error occured",'error')
							end_load()
						},
						success:function(resp){
							if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
								resp = JSON.parse(resp)
								if(Object.keys(resp).length > 0){
									$('#parcel_history').html('')
									Object.keys(resp).map(function(k){
										var tl = $('#clone_timeline-item .iitem').clone()
										tl.find('.dtime').text(resp[k].date_created)
										tl.find('.timeline-body').text(resp[k].status)
										$('#parcel_history').append(tl)
									})
								}
							}else if(resp == 2){
								alert_toast('Unkown Tracking Number.',"error")
							}
						}
						,complete:function(){
							end_load()
						}
					})
				}
			}
			$('#track-btn').click(function(){
				track_now()
			})
			$('#ref_no').on('search',function(){
				track_now()
			})
		</script>

		<footer class="layout-fixed" id="track_docs_footer">
		    <strong>Copyright &copy; 2021 <a href="https://www.itcodeline.com/">itcodeline.com</a>.</strong>
		    All rights reserved.
		    <div class="float-right d-none d-sm-inline-block">
		      	<b><?php echo $_SESSION['system']['name'] ?></b>
			</div>
		</footer>
	</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<?php include 'footer.php' ?>
</body>
</html>