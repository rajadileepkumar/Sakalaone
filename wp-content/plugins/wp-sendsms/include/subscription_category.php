<?php 
	function subscription_category_add(){
		$subscriptionCategory = $_POST['subscriptionCategory'];
		//echo $subscriptionCategory;
		//insert
		if(isset($_POST['save'])){
			global $wpdb;
			$table_name = $wpdb->prefix.'subscription_category';
			$sql = $wpdb->prepare("insert into $table_name (subscription_cat_name) values(%s)",$subscriptionCategory);
			//var_dump($sql);
			$wpdb->query($sql);
			$message.="Subscription Category inserted Successfully";
		}		
	?>
		<div class="container">
			  <div class="col-md-12">
			  <h2>Add New Subscription Category</h2>
			  	
				  <form role="form" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="category" class="form-horizontal">
					    <div class="form-group" id="subCat">
						      <label for="subscriptionCategory" class="col-xs-3">Enter Subscription Plan:</label>
							  <div class="col-xs-6">
							  	<input type="text" name="subscriptionCategory" id="subscriptionCategory" placeholder="Subscription Plan Name"  class="form-control catFormsub input-sm" require>
							  </div>
					    </div>
					    <button type="submit" class="btn btn-primary btn-md" id="save" name="save">Add New</button>
					    <?php if (isset($message)) {?><div class=""><p class="error"><?php echo $message;?></p></div><?php }else{ $message="Something Went Wrong";}?>
				  </form>
				</div>
		</div>
	<?php
}
?>