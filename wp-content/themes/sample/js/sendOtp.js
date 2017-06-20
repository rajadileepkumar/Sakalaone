var $ = jQuery.noConflict();
function sendOTP(isResend) {
        var mobileNumber,formvalid;
        if(isResend){
            mobileNumber = $('#username').html();    
        }
        else{
            mobileNumber = $('#user').val();
            formvalid = $('#sendOtpForm').valid();       
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
        return false;
    }