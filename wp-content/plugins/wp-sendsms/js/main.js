$(function() {

 //    $('#login-form-link').click(function(e) {
	// 	$("#login-form").delay(100).fadeIn(100);
 // 		$("#register-form").fadeOut(100);
	// 	$('#register-form-link').removeClass('active');
	// 	$(this).addClass('active');
	// 	e.preventDefault();
	// });
	// $('#register-form-link').click(function(e) {
	// 	$("#register-form").delay(100).fadeIn(100);
 // 		$("#login-form").fadeOut(100);
	// 	$('#login-form-link').removeClass('active');
	// 	$(this).addClass('active');
	// 	e.preventDefault();
	// });

	$('#register-form-link').click(function(e){
		$('#login-form').css('display','none');
		$('#register-form').css('display','block');
	});

});

$('#login-form-link').click(function(e){
	$('#register-form').css('display','none');
	$('#login-form').css('display','block');
});



$('#register-submit').on('click',function(e){
	if($('#rUserName').val()==''){
		$('#rUserName').css('border-color','red');
		return false;
	}

	else{
		$('#rUserName').css('border-color','')
	}

	if($('#rEmail').val()==''){
		$('#rEmail').css('border-color','red');
		return false;
	}

	else{
		$('#rEmail').css('border-color','');
	}

	if($('#rPassword').val()==''){
		$('#rPassword').css('border-color','red');
		return false;
	}

	else{
		$('#rPassword').css('border-color','');
	}

	if($('#rConfirmPassword').val()==''){
		$('#rConfirmPassword').css('border-color','red');
		return false;
	}

	else{
		$('#rConfirmPassword').css('border-color','');
	}
});

$('document').ready(function(){

	$('#register-form').validate({
	rules:{
		rUserName:{
			required: true,
			minlength:8,
			maxlength:15
		},
		rEmail:{
			required:true,
			email:true,
		},
		rPassword:{
			required:true,
			minlength:8,
			maxlength:15,
		},
		rConfirmPassword:{
			required:true,
			equalTo:'#rPassword',
		}
	},

	messages:{
		rUserName:{
			required:'Please Enter User Name',
			minlength:'User Name at least 8 characters',
		},
		rEmail:'Please Enter Valid Email',
		rPassword:{
			required:'Please Provide Password',
			minlength:'Password have at least 8 characters',
		},
		rConfirmPassword:{
			required:'Please retype Password',
			equalTo:'Password doesnt match',
		}
	}

	
});	
submitHandler:submitForm	
});

function submitForm(){
	var data = $('#register-form').serialize();

	$.ajax({
		type:'POST',
		url:'register.php',
		data:data,
		success:function(data){
			$('#login-form-link').html(result);
		}
		
	})
}