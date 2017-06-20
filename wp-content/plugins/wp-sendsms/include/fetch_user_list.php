<?php
require_once('../../../../wp-load.php'); 
$cat_id = ($_REQUEST["cat_id"] <> "") ? trim($_REQUEST["cat_id"]) : "";
	//echo $cat_id;
if ($cat_id <> "") {
	global $wpdb;
	$table_name = $wpdb->prefix.'wp_subscriber';
	$sql = "Select user_id from wp_usermeta where meta_value='$cat_id'";
	$user_id = $wpdb->get_results($sql);
	$userId = array();
	foreach ($user_id as $key) {
		$userId[] = $key->user_id;
	}
	$userId = implode(",", $userId);
	$currentDate = date('Y-m-d');
	$sql2 = "Select * from wp_users INNER JOIN wp_users_metadata ON wp_users.ID = wp_users_metadata.userId where wp_users.ID IN ($userId) and wp_users_metadata.paymentstatus=1 and wp_users_metadata.subendate >= '$currentDate'";
	var_dump($sql2);
	$result = $wpdb->get_results($sql2);
	?>

	<?php
	if (count($result) > 0) {
		?>
		<div class="form-group">
			<label class="col-md-4 control-label">Select Subscribers</label>
			<div class="col-md-4">
				<select name="adminmobile[]" id="adminmobile" multiple="multiple" class="selectpicker">
					<?php foreach($result as $key){?>
					<?php echo $_SESSION['adminmobile'] ?>
					<option value="<?php echo $key->user_login; ?>"><?php echo $key->user_login ?></option>
					<?php }?>
				</select>
			</div>
		</div>

		<script type="text/javascript">

		$(function () {
			$('#adminmobile').multiselect({
				includeSelectAllOption: true
			});
				            // $('.btn-primary').click(function () {
				            //     var selected = $("#multiSelect option:selected");
				            //     var message = "";
				            //     selected.each(function () {
				            //         message += $(this).text() + " " + $(this).val() + "\n";
				            //     });
				            //     alert(message);
				            // });
	});
		</script>

		<?php	
	}
	else{
		echo "<label class='col-md-4 control-label'></label>";
		echo "<div class='col-md-4'>";
			echo "No Data Found";
		echo "</div>";
	}	

}

?>