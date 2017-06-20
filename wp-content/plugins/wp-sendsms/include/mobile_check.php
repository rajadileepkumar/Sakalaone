<?php
	require_once('../../../../wp-load.php'); 
	$mobile = $_POST['mobile'];
	global $wpdb;
	$table_name = $wpdb->prefix.'subscriber';
	$sql = "select mobile from $table_name where mobile ='".$mobile."'";
	//echo $sql;
	$data = $wpdb->get_results($sql);
	//echo $data;

	if(count($data)>0){
		echo $mobile." is Already use";
	}
	else{
		echo "Ok";
	}
?>