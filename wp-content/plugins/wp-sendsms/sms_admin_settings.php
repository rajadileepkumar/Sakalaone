<?php
if(isset($_POST['setting_submit']))
{
	if (!wp_verify_nonce($_POST['setting_submit'],'sms_setting') )
	{
	   print 'Sorry, your nonce did not verify.';
	   exit;
	}
	else
	{		
		$options=$_POST;
		if(!isset($options['remove_bad_words'])) $options['remove_bad_words']='0';
		if(!isset($options['captcha'])) $options['captcha']='0';
		if(!isset($options['confirm_page'])) $options['confirm_page']='0';
		if(!isset($options['custom_response'])) $options['custom_response']='0';
		if(!isset($options['allow_without_login'])) $options['allow_without_login']='0';
		foreach($options as $option=>$value) 
		{
			update_option( $option, $value );
		}		
	}
}
?>
<div class="wrap col-xs-12">
<div id="icon-options-general" class="icon32"><br></div>
<h2>SMS Settings</h2>
<form action="" method="post" role="form" class="form-horizontal">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><label for="wpsms_api1"><strong>API 1:</strong> <br /> Useful Shortcodes: [Mobile], [TextMessage], [SenderID]</label></th>
				<td><textarea name="wpsms_api1" id="wpsms_api1" class="regular-text" cols="100" rows="5"><?php echo get_option('wpsms_api1'); ?></textarea></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="sender_id"><strong>Sender ID: </strong></label></th>
				<td><input type="text" name="sender_id" id="sender_id" value="<?php echo get_option('sender_id'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="remove_bad_words"><strong>Bad Words: </strong></label></th>
				<td><input type="checkbox" name="remove_bad_words" id="remove_bad_words" <?php if(get_option('remove_bad_words')) echo 'checked="checked"'; ?> value="1" /> Remove bad words from Message.</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="maximum_characters"><strong>Maximum Character Allowed: </strong></label></th>
				<td><input type="text" name="maximum_characters" class="maximum_characters" id="maximum_characters" value="<?php echo get_option('maximum_characters'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="captcha"><strong>Captcha: </strong></label></th>
				<td><input type="checkbox" name="captcha" id="captcha" <?php if(get_option('captcha')) echo 'checked="checked"'; ?> value="1" /> Enable Captcha in SMS form. 
				
					<div id="captcha_options" style="<?php if(!get_option('captcha')) echo 'display:none;' ?>">
						<table border="0">
							<tr>
								<td>Width: <input type="text" name="captcha_width" class="captcha_option_input" value="<?php echo get_option('captcha_width'); ?>" /></td>
								<td>Height: <input type="text" name="captcha_height" class="captcha_option_input" value="<?php echo get_option('captcha_height'); ?>" /></td>
								<td>Characters: <input type="text" name="captcha_characters" class="captcha_option_input" value="<?php echo get_option('captcha_characters'); ?>" /></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="confirm_page"><strong>Confirm Page: </strong></label></th>
				<td><input type="checkbox" name="confirm_page" id="confirm_page" <?php if(get_option('confirm_page')) echo 'checked="checked"'; ?> value="1" /> Enable Second Confirmation Page before sending SMS. (This will Show Mobile Number and Text Message Before sending for Confirmation. )</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="allow_without_login"><strong>Allow Send Message: </strong></label></th>
				<td><input type="checkbox" name="allow_without_login" id="allow_without_login" <?php if(get_option('allow_without_login')) echo 'checked="checked"'; ?> value="1" /> Allow Visitors to send message without Login.</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="custom_response"><strong>Custom Response: </strong></label></th>
				<td><input type="checkbox" name="custom_response" id="custom_response" <?php if(get_option('custom_response')) echo 'checked="checked"'; ?> value="1" /> Enable Custom Response Text After Calling the API.
					<div id="custom_response_div" style="<?php if(!get_option('custom_response')) echo 'display:none;'; ?>">
					<table>
						<tr>
							<td>Custom response text: </td>
							<td><textarea name="custom_response_text" cols="100" rows="5"><?php echo get_option('custom_response_text'); ?></textarea></td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<input type="submit" value="Update Settings" class="btn btn-primary" />
	<?php wp_nonce_field('sms_setting','setting_submit'); ?>
</form>
</div>