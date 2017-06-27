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