  <aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: #343a40">
    <div class="dropdown" style="background-color: #900C3F">

   	<a href="./" class="brand-link" style="background-color: #343a40 ">
      <h3 class="text-center p-0 m-0">
      <img src="./assets/images/logo.png" alt="logo" class="img-circle" id="brand-logo">
        <?php if($_SESSION['login_type'] == 1){
          echo '<b>ADMIN</b>';
        }elseif ($_SESSION['login_type'] == 2) {
          echo '<b>STAFF</b>';
        }else{
          echo '<b>USER</b>';
        }
        ?>
      </h3>
    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4" style="background-color: #343a40">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>     
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_branch">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Office
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_office" class="nav-link nav-new_office tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=office_list" class="nav-link nav-office_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Office Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_staff" class="nav-link nav-new_staff tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=staff_list" class="nav-link nav-staff_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['login_type'] == 1 OR $_SESSION['login_type'] == 2): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_document" class="nav-link nav-new_document tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=document_list" class="nav-link nav-document_list nav-sall tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List All</p>
                </a>
              </li>

              <?php
              if($_SESSION['login_type'] == 1 OR $_SESSION['login_type'] == 2):  
              
                $status_arr = array("Tracking Number Generated","Collected","Action Taken","Pending","Lacking Documents","Picked Up");
                foreach($status_arr as $k =>$v):
              ?>
                <li class="nav-item">
                  <a href="./index.php?page=document_list&s=<?php echo $k ?>" class="nav-link nav-document_list_<?php echo $k ?> tree-item">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p><?php echo $v ?></p>
                  </a>
                </li>
            <?php 
                endforeach; 
              endif;
            ?>
            </ul>
          </li>
           <li class="nav-item dropdown">
            <a href="./index.php?page=track" class="nav-link nav-track">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Track Documents
              </p>
            </a>
           </li>
           <?php if($_SESSION['login_type'] == 1 OR $_SESSION['login_type'] == 2): ?>  
           <li class="nav-item dropdown">
            <a href="./index.php?page=reports" class="nav-link nav-reports">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <?php endif;?>  
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>