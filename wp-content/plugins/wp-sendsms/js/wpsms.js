jQuery(document).ready(function() {

jQuery('#captcha').change(function() {
	jQuery('#captcha_options').toggle('slide');
});

jQuery('#custom_response').change(function() {
	jQuery('#custom_response_div').toggle('slide');
});

jQuery('#message').keydown(function() {
	var maxlength=jQuery(this).attr("max");
	var curlength=jQuery(this).val().length;
	var remains=maxlength-curlength;
	if(remains<=0) 
	{
		remains=remains;
		jQuery(this).css('border-color','#ff0000');
		jQuery('#char_count').css('color','#ff0000');
	}
	jQuery('#char_count').html(remains);
});
 
});