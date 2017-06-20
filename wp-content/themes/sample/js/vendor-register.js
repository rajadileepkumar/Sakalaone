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
    $.ajax({
        method:'POST',
        url:ajax_object.ajax_url,
        data:{
            'action' :'my_request_availabulity_username',
            'vuserName' : vuserName,
        },
        success:function(data){
            if(data){
                $('#v-available').html(data);
                // $('#vendorRegister').attr("disabled","disabled");
            }else{
                $('#v-available').html(data);
                // $('#vendorRegister').removeAttr("disabled");    
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
            if(data){
                $('#v-email-available').html(data);
                // $('#vendorRegister').attr("disabled","disabled");
            }else if(data){
                $('#v-email-available').html(data);
                $('#vendorRegister').removeAttr("disabled");
                
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
            if(data){
                // $('#vendorRegister').attr("disabled","disabled");
                $('#v-mobile-available').html(data);    
            }else{
                $('#vendorRegister').removeAttr("disabled");
                $('#v-mobile-available').html(data);    
            }
            
            console.log(data);
        },
        error:function (errorThrown) {
            console.log(errorThrown)
        }
    });
    return false;
});