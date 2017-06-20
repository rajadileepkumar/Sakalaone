var $ = jQuery.noConflict();

$(function () {
    $('#multiSelect').multiselect({
        includeSelectAllOption: true
    });
    // $('.btn-primary').click(function () {
    //     var selected = $("#multiSelect option:selected");
    //     var message = "";
    //     selected.each(function () {
    //         message += $(this).text() + " " + $(this).val() + "\n";
    //     });
    //     alert(message);
    // });

    $('#category').validate({
        rules:{
            subscriptionCategory:{
                required:true,
                minlength:4,
                maxlength:15,
                lettersonly:true
            },

        },
        messages:{
            subscriptionCategory:{
                required:'Please Enter Category Name',
                minlength:'Category Name Should be at least 4 characters',
                lettersonly:'Enter characters Only'
            }   
        }
    });

   

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value); 
    });

        
    $.validator.addMethod("needsSelection", function (value, element) {
        var count = $(element).find('option:selected').length;
        return count > 0;
    });
    $('#newsubscriber').validate({
        rules:{
            firstName:{
                required:true,
                minlength:4,
                maxlength:15,
                lettersonly:true
            },
            
            mobile:{
                required:true,
                minlength:10,
                maxlength:10,
                digits: true

            },
            'categoryList[]':{
                needsSelection:true
            },
            

        },
        messages:{
            firstName:{
                required:'Please Enter First Name',
                minlength:'First Name Should be at least 4 characters',
                lettersonly:'Enter Only alphabits'
            },
            
            mobile:{
                required:'Enter Your Mobile Number',
                minlength:'Mobile Number Should be only numbers'
            },
            'categoryList[]':{
                needsSelection:'Please selected any category'
            } ,
            
        }

    });
    
    $('#wp-sms-form').validate({
        rules:{
            multiSelectSubscription:{
                needsSelection:true
            },
            adminmessage:{
                required:true
            },
            'adminmobile[]':{
                needsSelection:true
            },
            agree: "required"
        },
        messages:{
            multiSelectSubscription:{
                needsSelection:'Please selected any category'
            },
            adminmessage:{
                required:'Please Enter Some message',
            },
            'adminmobile[]':{
                needsSelection:'Please selected any Mobile'
            } ,

            agree: ""  
        }
    });
    
    // $('#mobile').blur(function(e) {
    //     if (validatePhone('mobile')) {
    //         $('#spnPhoneStatus').html('Valid');
    //         $('#spnPhoneStatus').css('color', 'green');
    //     }
    //     else {
    //         $('#spnPhoneStatus').html('Invalid');
    //         $('#spnPhoneStatus').css('color', 'red');
    //     }
    // });
    

    // function validatePhone(mobile) {
    //     var a = document.getElementById(mobile).value;
    //     var filter = /^[0-9-+]+$/;
    //     if (filter.test(a)) {
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    // }

    
});

