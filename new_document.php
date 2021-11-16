<?php if(!isset($conn)){ include 'db_connect.php'; } ?>


<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-parcel" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class=""></div>
        <div class="row">
          <div class="col-md-6">
              <b>Sender Information</b>
              <br>
              <br>
              <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="sender_name" class="form-control form-control-sm" value="<?php echo isset($sender_name) ? $sender_name : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Station / School</label>
                <input type="text" name="station_school" class="form-control form-control-sm" value="<?php echo isset($station_school) ? $station_school : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Station Address</label>
                <input type="text" name="station_address" class="form-control form-control-sm" value="<?php echo isset($station_address) ? $station_address : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">District</label>
                <input type="text" name="sender_dis" class="form-control form-control-sm" value="<?php echo isset($sender_dis) ? $sender_dis : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact Number</label>
                <input type="text" name="sender_contact" class="form-control form-control-sm" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" required>
              </div>
          </div>
          <div class="col-md-6">
              <b>Recipient Information</b>

              <br>
              <br>
              <div class="form-group">
                <label for="" class="control-label">Name of Office</label>
               <!-- <input type="text" name="office_name" class="form-control form-control-sm" value="<?php echo isset($office_name) ? $office_name : '' ?>" required> -->
                <select id="offices" name="office_name" class="form-control form-control-sm" value="<?php echo isset($office_name) ? $office_name : '' ?>" required>
    <option value="Office of the Superintendent">Office of the Superintendent</option>
    <option value="Office of the Assistant Superintendent">Office of the Assistant Superintendent</option>
    <option value="SGOD">SGOD</option>
    <option value="CID">CID</option>
    <option value="HRMO">HRMO</option>
    <option value="DPSU">DPSU</option>
    <option value="Records">Records</option>
    <option value="Cashier">Cashier</option>
    <option value="Accounting">Accounting</option>
    <option value="ITO">ITO</option>
    <option value="Others: ">Others</option>
  </select>
              </div>
              <div class="form-group">
                <input type="text" name="other_sp" class="form-control form-control-sm" >
                <small><i>IF <b>"OTHERS"</b> (PLEASE SPECIFY. Else leave it blank)</i></small>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Person in Charge (PLEASE SPECIFY)</label>
               <!-- <input type="text" name="pic" class="form-control form-control-sm" value="<?php echo isset($pic) ? $pic : '' ?>" required> -->
               <select id="personincharge" name="pic" class="form-control form-control-sm" value="<?php echo isset($pic) ? $pic : '' ?>" required>
    <option value="Office of the Superintendent">Office of the Superintendent</option>
    <option value="Office of the Assistant Superintendent">Office of the Assistant Superintendent</option>
    <option value="SGOD">SGOD</option>
    <option value="CID">CID</option>
    <option value="HRMO">HRMO</option>
    <option value="DPSU">DPSU</option>
    <option value="Records">Records</option>
    <option value="Cashier">Cashier</option>
    <option value="Accounting">Accounting</option>
    <option value="ITO">ITO</option>
    <option value="Others: ">Others</option>
  </select>
   
              </div>
              
             <!-- <div class="form-group">
                <label for="" class="control-label">Contact #</label>
                <input type="text" name="recipient_contact" class="form-control form-control-sm" value="<?php echo isset($recipient_contact) ? $recipient_contact : '' ?>" required>
              </div> -->
              <div class="form-group">
              <label for="desc">Document Description</label>
              <textarea name="description" id="desc" class="form-control form-control-sm" rows="3"></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
        <div class="col-md-6">
           
            
           <!-- <div class="form-group">
              <label for="dtype">Type</label>
              <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : '' ?> data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" class="switch-toggle status_chk" data-size="xs" data-offstyle="info" data-width="5rem" value="1">
              <small>Deliver = Deliver to Recipient Address</small>
              <small>, Pickup = Pickup to nearest Office</small>
            </div> -->
          </div>
        <!-- <div class="col-md-6" id=""  <?php echo isset($type) && $type == 1 ? 'style="display: none"' : '' ?>>
            <?php if($_SESSION['login_branch_id'] <= 0): ?>
              <div class="form-group" id="fbi-field">
                <label for="" class="control-label">Office Processed</label>
              <select name="from_branch_id" id="from_branch_id" class="form-control select2" required="">
                <option value=""></option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected":'' ?>><?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <?php else: ?>
              <input type="hidden" name="from_branch_id" value="<?php echo $_SESSION['login_branch_id'] ?>">
            <?php endif; ?>  
            <div class="form-group" id="tbi-field">
              <label for="" class="control-label">Pickup Office</label>
              <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                <option value=""></option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected":'' ?>><?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; 
                   $update_at = date('Y-m-d H:i:s');
                ?>
              </select>
            </div>
          </div> -->
        </div>
        <hr>
        <div class="hidden">
          <input type="hidden" name="created_by" value="<?php echo $_SESSION['login_id'];?>">
          <input type="hidden" name="updated_at" value="<?php echo $update_at;?>">
        <!--  <input type="hidden" name="creator_name" value="<?php echo $_SESSION['login_name'];?>"> -->
        </div>
        
              <?php if(!isset($id)): ?>

        <!-- <div class="row">
          <div class="col-md-12 d-flex justify-content-end">
            <button  class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="new_parcel"><i class="fa fa-item"></i> Add Item</button>
          </div>
        </div> -->
              <?php endif; ?>
        
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-parcel">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=document_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<div id="ptr_clone" class="d-none">
  <table>
    <tr>
        <td><input type="text" name='weight[]' required></td>
        <td><input type="text" name='height[]' required></td>
        <td><input type="text" name='length[]' required></td>
        <td><input type="text" name='width[]' required></td>
      <!--  <td><input type="text" class="text-right number" name='price[]' required></td> -->
        <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
      </tr>
  </table>
</div>
<script>
  $('#dtype').change(function(){
      if($(this).prop('checked') == true){
        $('#tbi-field').hide()
      }else{
        $('#tbi-field').show()
      }
  })
    $('[name="price[]"]').keyup(function(){
      calc()
    })
  $('#new_parcel').click(function(){
    var tr = $('#ptr_clone tr').clone()
    $('#parcel-items tbody').append(tr)
    $('[name="price[]"]').keyup(function(){
      calc()
    })
    $('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val)
    })

  })
	$('#manage-parcel').submit(function(e){
		e.preventDefault()
		// start_load()
    // if($('#parcel-items tbody tr').length <= 0){
      // alert_toast("Please add atleast 1 parcel information.","error")
      // end_load()
      // return false;
    // }
    
		$.ajax({
			url:'ajax.php?action=save_parcel',
			type: 'POST',
      method: 'POST',
      data: new FormData($(this)[0]),
		  cache: false,
		  contentType: false,
		  processData: false,
			success:function(resp){
        var data = JSON.parse(resp);
        if(data.status == 1){
            alert_toast('Data successfully saved',"success");
            setTimeout(function(){
              window.location.href = 'index.php?page=document_list&id='+data.id;
            },2000)
        }
			},
      error: function(xhr, status, error){
         var errorMessage = xhr.status + ': ' + xhr.statusText
         alert('Error - ' + errorMessage);
      }
		})
	})

  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  function calc(){

        var total = 0 ;
         $('#parcel-items [name="price[]"]').each(function(){
          var p = $(this).val();
              p =  p.replace(/,/g,'')
              p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
         })
         if($('#tAmount').length > 0)
         $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
  }
</script>