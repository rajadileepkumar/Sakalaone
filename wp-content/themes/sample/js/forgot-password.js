$(document).ready(function(){
    $("#lostpasswordform").validate({
        rules:{
            user_login:{
                required:true,
                minlength:10,
                maxlength:10,
                digits: true
            }
        },
        messages:{
            user_login:{
                required:'Enter Your Mobile Number',
                minlength:'Mobile Number Should be only numbers'
            },
        }
    });
});

function sendForgot(){
    var mobileNumber,formvalid,template;
    mobileNumber = $('#user_login').val();
    formvalid = $('#lostpasswordform').valid();
    template = 'Forgot';
    if(formvalid){
        $.ajax({
            method:'GET',
            dataType:'json',
            url:ajax_object.ajax_url,
            data:{
                'action' :'my_request_OTP',
                'number' : mobileNumber,
                'template' : template
            },
            success:function(data){
                if(data['Status'] == "Success"){
                    $('#resultOTP').val(data['Details']);
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