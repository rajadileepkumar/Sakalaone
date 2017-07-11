$(document).ready(function(){
$("#vendorRegisterForm").validate({
        rules:{
             vFirstName:{
                required:true,
            },
            vUserName:{
                required:true,
                minlength:8,
                maxlength:15
            },
            vPassword:{
                required:true,
                minlength:6,
                maxlength:15
            },
            vConfirmPassword:{
                required:true,
                minlength:6,
                maxlength:15,
                equalTo:'#vPassword'
            },
            vEmail:{
              required:true
            },
            vMobile:{
                required:true,
                minlength:10,
                maxlength:10,
                digits: true
          },
          terms:{
            required:true
          }
    },
    messages:{
	        vFirstName:{
                required:'Enter Your First Namee',
            },
            vUserName:{
	            required:'Enter Your User Name',
                minlength:'Minimun 8 and Maximum 15 characters is required'
	        },
	        vPassword:{
	            required:'Enter Password',
	            minlength:'Minimun 6 and Maximum 15 characters is required'
	        },
	        vConfirmPassword:{
	            required:'Enter Confirm Password',
	            minlength:'Minimun 6 and Maximum 15 characters is required',
	            equalTo:'Password and confirm password should be equal'    
	        },
	        vEmail:{
	            required:'Enter Valid Email'
	        },
	        vMobile:{
	            required:'Enter Your Mobile Number',
	            minlength:'Mobile Number Should be only numbers'
	        },
	        terms:{
	            required:'Accept terms and conditions'
	        }
	}
 });
});


function vendorRegisterClick(){
	$('#vendorRegisterForm').valid();       
    /*var mobileNumber,formvalid;
    if(isResend){
       mobileNumber = $('#vMobile').html();    
    }
    else{
        mobileNumber = $('#vMobile').val();
        formvalid = $('#vendorRegisterForm').valid();       
    }
    if(formvalid || isResend){

            $.ajax({
                method:'GET',
                dataType:'json',
                url:ajax_object.ajax_url,
                data:{
                    'action' :'my_request_OTP',
                    'number' : mobileNumber,
                },
                success:function(data){
                    if(data['Status'] == "Success"){
                        $('#resultOTP').val(data['Details']);
                        if(!isResend){
                            $('#sendOtpForm').submit();        
                        }
                    }
                    else{
                        return false;
                    }
                    
                },
                error:function (errorThrown) {
                    console.log(errorThrown);
                    return false;
                }
            });    
        }
        return false;*/
}

$(document).on("keyup", "#vUserName", function () {
    var vuserName = $('#vUserName').val();
    //$('#vendorRegister').prop( "disabled", true );
    $.ajax({
        method:'POST',
        url:ajax_object.ajax_url,
        data:{
            'action' :'my_request_availabulity_username',
            'vuserName' : vuserName,
        },
        success:function(data){
            var msg="UserName Not available";
            if(data == 1){
                $('#vendorRegister').removeClass('active').addClass('disabled');
                $('#vUserName').addClass('notavailable').removeClass('available');
                $('#v-available').html(msg+" "+vuserName);
            }else{
                msg = "UserName Available";
                $('#vendorRegister').removeClass('disabled').addClass('active');
                $('#vUserName').addClass('available').removeClass('notavailable');
                $('#v-available').html(msg+" "+vuserName);
            }
        },
        error:function (errorThrown) {
            console.log(errorThrown)
        }
    });
    return false;
});

$(document).on("keyup", "#vEmail", function () {
    var vEmail = $('#vEmail').val();
    $.ajax({
        method:'POST',
        url:ajax_object.ajax_url,
        data:{
            'action' :'my_request_availabulity_email',
            'vEmail' : vEmail,
        },
        success:function(data){
            var msg="Email Id Already Exists";
            if(data == 1){
                $('#vendorRegister').removeClass('active').addClass('disabled');
                $('#vEmail').addClass('notavailable').removeClass('available');
                $('#v-email-available').html(msg+" "+vEmail);
            }else{
                msg = "Email Id Available";
                $('#vendorRegister').removeClass('disabled').addClass('active');
                $('#vEmail').addClass('available').removeClass('notavailable');
                $('#v-email-available').html(msg+" "+vEmail);
            }
            
            console.log(data);
        },
        error:function (errorThrown) {
            console.log(errorThrown)
        }
    });
    return false;
});

$(document).on("keyup", "#vMobile", function () {
    var vuserName = $('#vMobile').val();
    $.ajax({
        method:'POST',
        url:ajax_object.ajax_url,
        data:{
            'action' :'my_request_availabulity_mobile',
            'vuserName' : vuserName,
        },
        success:function(data){
            var msg="Mobile Number Already Exists";
            if(data == 1){
                $('#vendorRegister').removeClass('active').addClass('disabled');
                $('#vMobile').addClass('notavailable').removeClass('available');
                $('#v-mobile-available').html(msg+" "+vuserName);
            }else{
                msg = "Mobile Available";
                $('#vendorRegister').removeClass('disabled').addClass('active');
                 $('#vMobile').addClass('available').removeClass('notavailable');
                $('#v-mobile-available').html(msg+" "+vuserName);
            }
            
            console.log(data);
        },
        error:function (errorThrown) {
            console.log(errorThrown)
        }
    });
    return false;
});
$(document).ready(function(){
    $('#vendorRegisterConfirm').click(function(){
        var firstName = $('#firstName').html();
        var lastName = $('#lastName').html();
        var userName = $('#userName').html();
        var email = $('#email').html();
        var mobile = $('#mobile').html();
        var password = $('#password').html();
        var home = $('#homeUrl').html();
        //alert("firstName"+firstName+"lastName"+lastName+"userName"+userName+"email"+email+"password"+password);
        $.ajax({
            method:'POST',
            url:ajax_object.ajax_url,
            data:{
                'action' :'my_request_vendor_register',
                'firstName' : firstName,
                'lastName' : lastName,
                'userName' : userName,
                'email' : email,
                'mobile':mobile,
                'password' : password,
            },
            success:function(data){
                if(data == 1){
                    window.location.href =  home;
                }
            },
            error:function (errorThrown) {
                console.log(errorThrown)
            }

        });
        
    });
    return false;
});
