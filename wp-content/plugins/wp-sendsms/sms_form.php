<?php
ob_start();
$errors="";
if(isset($_GET['sent']) && $_GET['sent']==1)
{
	//show Response or custom message
	unset($_SESSION['confirm_page']);
	unset($_SESSION['mobile']);
	unset($_SESSION['message']);
	echo $_SESSION['response'];
}
else if(isset($_SESSION['confirm_page']))
{
	?>
	<form action="" method="post" id="confirm-wp-sms-form">
		<table>
			<tr>
				<td>Mobile: </td>
				<td><?php echo $_SESSION['mobile']; ?></td>
			</tr>
			<tr>
				<td>Message: </td>
				<td><?php echo $_SESSION['message']; ?></td>
			</tr>
			<tr>
				<td colspan="2">
				<?php if(get_option('remove_bad_words')) {
					echo "<p>Note: Bad Words in the message is removed</p>";
				} ?>
				<input type="submit" id="submit" value="Click here to Send SMS" /></td>
			</tr>
		</table>
		<?php wp_nonce_field('confirm_send_sms','confirm_send_sms_nonce'); ?>
	</form>
	<?php
}
else
{
	if(!empty($errors)) {
	?>
	<div class="errors">
		<ul>
			<?php echo $errors; ?>
		</ul>
	</div>
	<?php } ?>
	<form action="" method="post" id="wp-sms-form">
		<table>
			<tr>
				<td>Mobile: </td>
				<td><input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['mobile'] ?>" /></td>
			</tr>
			<tr>
				<td>Message: </td>
				<td>Character Remains: <span id="char_count"><?php echo get_option('maximum_characters'); ?></span>
				<br />
				<textarea name="message" id="message" max="<?php echo get_option('maximum_characters'); ?>"><?php echo $_SESSION['message'] ?></textarea><?php if(get_option('remove_bad_words')) {
					echo "<p>Note: Bad Words in the message will be removed</p>";
				} ?></td>
			</tr>
			<?php if(get_option('captcha')) { ?>
			<tr>
				<td>Security Code: </td>
				<td><span id="wpsms_captcha_image"><img src="<?php echo WP_PLUGIN_URL; ?>/wp-sendsms/captcha/CaptchaSecurityImages.php?width=<?php echo get_option('captcha_width'); ?>&height=<?php echo get_option('captcha_height'); ?>&characters=<?php echo get_option('captcha_characters'); ?>" alt="" /></span> 
				<input type="text" name="security_code" id="security_code" /></td>
			</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" id="submit" value="Send SMS" /></td>
			</tr>
		</table>
		<?php wp_nonce_field('send_sms','send_sms_nonce'); ?>
	</form>
<?php }
$content = ob_get_clean();
 ?>