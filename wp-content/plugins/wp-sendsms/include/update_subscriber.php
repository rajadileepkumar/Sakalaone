<?php 
	function update_subscriber(){
		$id = $_REQUEST['id'];
		echo $id;
		global $wpdb;
		//$id = $_REQUEST['id'];
		$fName = $_POST['fName'];
		$lName = $_POST['lName'];
		$categoryList = $_POST['categoryList'];
		//$categoryList = isset($_POST['categoryList']) ?$_REQUEST['categoryList']:array();
		//if(is_array($categoryList)) $categoryList =implode(',', $categoryList);
		//$sids= $_POST['sid'];
		$sids = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : array();
		if (is_array($sids)) $sids = implode(',', $sids);
		$message ='';
		
		$table_name = $wpdb->prefix.'subscriber';
		$table_name1 = $wpdb->prefix.'subscription';
		$result = "Select firstname,lastname,sname,sid from $table_name inner join $table_name1 on $table_name.id=$table_name1.aid where id=$id";
		//var_dump($result);
		$data1 = $wpdb->get_results($result);
		//print_r($data1);
		foreach ($data1 as $item) {
			
			$firstName = $item->firstname;
			$lastName = $item->lastname;
			
		}
		if(isset($_POST['update'])){
			
			// if(is_array($sid)){
			// 	if(is_array($categoryList)){
			// 		foreach ($sid as $s) {
			// 			foreach ($categoryList as $key) {
			// 				$key;
			// 				print_r($key);
					
							//$array_combine = array_combine($sid, $categoryList);
				// 		}
				// 	}
				// }
				//print_r($array_combine);

			//exit();
				if($sids ){
					if(is_array($categoryList)){
			 	foreach ($categoryList as $key ) {
					$update_result = "update $table_name inner join $table_name1 on $table_name.id=$table_name1.aid set sname='".$key."' where $table_name.id = $id and sid in($sids)";
					var_dump($update_result);
					
					}	}exit();
				}
				if($update_result){
					$message .='Updated Sucessfully';
				}
				else{
					$message .='Unable To Update';
				}
				
			}

			// $update_result = "update $table_name inner join $table_name1 on $table_name.id=$table_name1.aid set sname='".$key->sname."' where $table_name.id = $id and sid in($s)";
			// 			//$delete_result = $wpdb->query("DELETE sname from $table_name1 inner join $table_name on $table_name.id = $table_name1.aid WHERE $table_name.id=$id");
			// var_dump($update_result);
						
					
					//$result = $update_result = "update $table_name inner join $table_name1 on $table_name.id=$table_name1.aid set sname='".$key."' where $table_name.id = $id and sid in($s)";
					//$delete_result = $wpdb->query("DELETE sname from $table_name1 inner join $table_name on $table_name.id = $table_name1.aid WHERE $table_name.id=$id");
					//var_dump($result);
					//exit();
					//$update = $wpdb->update($table_name1,array('sid'=>'','sname'=>$key),array('aid'=>$id,'sid'=>'$sid'),array('%s'),array('%d','%d'));
					//print_r($update);
					
					
				//}
				
				// if($result){
				// 	$message .='Updated Sucessfully';
				// }
				// else{
				// 	$message .='Unable To Update';
				// }
				//print_r($list);
				
					//$update_result = "update $table_name1 inner join $table_name1 on $table_name.id=$table_name1.aid set firstname='".$fName."',lastname='".$lName."',sname='".$key."' where $table_name.id=$id";
					
			//}
		//}
		//}
		//exit();
	//}
			
		?>
			<div class="container">
				<div class="col-md-12">
					<a class="add-new-h2"
                                 href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=subscribe_list');?>"><?php _e('Back To List', 'custom_table_example')?></a>
					<h2><?php _e('Update Subscriber','sample');?></h2>
					<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="updatesubscriber" class="form-horizontal">
						<div class="form-group">
							<label class="col-md-3 col-xs-12"><?php _e( 'First Name : ', 'sample' ); ?></label>
							<div class="col-md-5 col-xs-12"><input class="form-control" type="text" name="fName" placeholder = "First Name" id="fName" value="<?php echo $firstName; ?>"/></div>
						</div>

						<div class="form-group">
							<label class="col-xs-12 col-md-3"><?php _e( 'Last Name : ', 'sample' ); ?></label>
							<div class="col-md-5 col-xs-12"><input class="form-control" type="text" name="lName" id="lName" placeholder="<?php echo esc_attr( 'Last Name', 'sample' ); ?>" value="<?php echo $lastName;?>"/></div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-md-3" for="Subscription List"><?php _e( 'Subscription List', 'sample' ); ?></label>
							<div class="col-xs-12 col-md-5">
								<select name="categoryList[]" multiple="multiple" id="multiSelect">
		                        	<?php 
		                        		global $wpdb;
		                        		$table_name = $wpdb->prefix.'category';
		                        		echo $table_name;
		                        		$sql = "select id,name from $table_name";
		                     			$data = $wpdb->get_results($sql);
		                     			foreach ($data as $key) {
		             						//echo "<option value='".$key->name."'>".$key->name."</option>";
		             						foreach ($data1 as $item) {
		             							//print_r($item->sname);
		             							//print_r($key->name);
		             							//print_r($key->name == $item->sname);
		             							if($key->name == $item->sname){

		             								echo "<option selected value='".$key->name."'>".$key->name."</option>";
		             								
		             							}
		             							else{
		             								echo "<option value='".$key->name."'>".$key->name."</option>";
		             							}
		             							break;
		             						}
		             					}
		             				
		             				foreach($data1 as $id){
		             						?><input type="hidden" value="<?php echo $id->sid;?>" name="sid[]"/><?php	
		             					}
		                        	?>
		                        </select>
	                    	</div>
						</div>
						<!-- <div class="form-group col-sm-6"> -->
							<input type="submit" value="Update" class="sb sb-btn" name="update">
						<!-- </div> -->
					</form>
					<?php if (isset($message)): ?><div class=""><p class="error"><?php echo $message;?></p></div><?php endif;?>
				</div>
			</div>
		<?php
	}
?>