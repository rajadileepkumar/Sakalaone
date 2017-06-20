var $ = jQuery.noConflict();
function verifyOTP(){
        var otpNumner = $('#gotp').val();
        var sessionId = $('#resultOTP').val();
        if(otpNumner && sessionId){
            $.ajax({
            method:'GET',
            url:ajax_object.ajax_url,
            data:{
                'action' :'my_request_verifyOTP',
                'otpNumner' : otpNumner,
                'sessionId' : sessionId,
            },
            success:function(data){
                var ressult = JSON.parse(data);
                if(ressult.Status == "Error"){
                    $('#InvalidOtp').html('Invalid OTP');
                }
                else{
                    $('#customerData').submit();    
                }
                
            },
            error:function (errorThrown) {
                $('#InvalidOtp').html('Invalid OTP')
                console.log("error");
            }
         });    
        }
        else{
            $('#customerData').submit();        
        }
        
        return false;

    }