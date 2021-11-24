<?php
function getSystem($conn){
	if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
    return true;
  }
  return false;
}
function getTitle(){
	$pageURL = str_replace(".php","",$_SERVER['PHP_SELF']);
	$chunk = explode('/', $pageURL);

	$title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
	if(!isset($_GET['page'])){
		if($chunk[2] == 'print_document'){
			$title = 'Print';
		}
		if($chunk[2] == 'login'){
			$title = 'Login';
		}
	}
  	$title = str_replace("Persons Companies","Persons/Companies",$title);

  	return $title;
}
function optionOffice($conn){
	$qry = $conn->query("SELECT name from branches");
	$option = '';
	while ($row = $qry->fetch_assoc()) :
	$option .= '<option value ="'.$row['name'].'">'. $row['name'].'</option>';
	endwhile;
	
	echo $option;
}
?>