<?php 
	function add_subscriber(){
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$mobile = $_POST['mobile'];
		$categoryList = $_POST['categoryList'];
		
		//$categoryList1 = implode(',',$categoryList);
		if(is_array($categoryList)){
				foreach ($categoryList as $key) {
				$key;
			}
		}
		if(isset($_POST['add'])){
			global $wpdb;
			$table_name = $wpdb->prefix.'subscriber';
			$table_name1 = $wpdb->prefix.'subscription';

			$sql2 = $wpdb->prepare("select * from $table_name where mobile = '".$mobile."'",$mobile);
			//var_dump($sql2);
			$data1 = $wpdb->get_results($sql2);

			if(count($data1) == 0){
				$sql = $wpdb->prepare("insert into $table_name (firstname,lastname,mobile) values(%s,%s,%s)",$firstName,$lastName,$mobile);
				$wpdb->query($sql);
				$lasid = $wpdb->insert_id;
				if(is_array($categoryList)){
					foreach ($categoryList as $key) {
						$sql1 = $wpdb->prepare("insert into $table_name1 (sname,aid) values(%s,%s)",$key,$lasid);
						$wpdb->query($sql1);
					}
				}
				$message.="Subscriber Added Sucessfully";
			}
			else{
				$message .="Unable To Add Subscriber or Subsciber Already Added";
			}
		}
	
		?>
			<div class="container">
			    <div class="col-md-12">
				    <h2><?php _e( 'Add New Subscriber', 'sample' ); ?></h2>
					<div class="margin-20"></div>
					<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="newsubscriber" class="form-horizontal">
						
						<div class="form-group">
							<label class="col-xs-3"><?php _e( 'First Name : ', 'sample' ); ?></label>
							<div class="col-xs-5"><input class="form-control" type="text" name="firstName" placeholder = "First Name" id="firstName"/></div>
						</div>

						<div class="form-group">
							<label class="col-xs-3"><?php _e( 'Last Name : ', 'sample' ); ?></label>
							<div class="col-xs-5"><input class="form-control" type="text" name="lastName" id="lastName" placeholder="<?php echo esc_attr( 'Last Name', 'sample' ); ?>"/></div>
						</div>
						<div class="form-group">
							<label for="MobileNumber" class="col-xs-3"><?php _e( 'Mobile : ', 'sample' ); ?></label>
							<div class="col-xs-5"><input class="form-control" type="text" name="mobile" id="mobile" placeholder="<?php echo esc_attr( 'Mobile', 'sample' ); ?>" />
							<span id="spnPhoneStatus" class="error"></span></div>
						</div>
						<div class="form-group">
							<label class="col-xs-3" for="Subscription List"><?php _e( 'Subscription List', 'sample' ); ?></label>
							<div class="col-xs-5">
								<select name="categoryList[]" multiple="multiple" id="multiSelect">
		                        	<?php 
		                        		global $wpdb;
		                        		$table_name = $wpdb->prefix.'subscription_category';
		                        		echo $table_name;
		                        		$sql = "select id,subscription_cat_name from $table_name";
		                     			$data = $wpdb->get_results($sql);
		                     			foreach ($data as $key) {
		             						echo "<option value='".$key->subscription_cat_name."'>".$key->subscription_cat_name."</option>";
		             					}		
		                        	?>
		                        </select>
	                    	</div>
						</div>
						<!-- <div class="form-group col-sm-6"> -->
							<input type="submit" value="Add Subscriber" class="btn btn-primary" name="add">
						<!-- </div> -->
				    </form>
				    <?php if (isset($message)): ?><div class=""><p class="error"><?php echo $message;?></p></div><?php endif;?>
			    </div>
			</div>
			<script type="text/javascript">
				
				$('#mobile').keyup(function (argument) {
					var mobile =  $('#mobile').val();
					console.log(mobile);
					var url="<?php echo plugin_dir_url(__FILE__).'mobile_check.php'?>";
					$.ajax({
						type:"POST",
						url : url,
						data : "mobile="+mobile,
						success:function(html){
							$('#spnPhoneStatus').html(html);
						}
					});
				});	
			</script>
		<?php
	}

	
	

?>