<?php
/**
 * Created by PhpStorm.
 * User: Raja
 * Date: 06-Dec-16
 * Time: 4:21 PM
 * Template Name:Register Page
 */
get_header();?>
<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <?php if (!is_user_logged_in()) {?>
                <div class="container">
                    <div class="step1">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center">Sign Up</h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php if(defined('REGISTRATION_ERROR')){
                                foreach(unserialize(REGISTRATION_ERROR) as $error){
                                    echo '<p class="order_error text-center">'.$error.'</p><br>';
                                }
                            }?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="sendOtpForm" method="post" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>" class="form_comment form-horizontal">
                                <div class="form-group">
                                    <label for="username" class="col-md-4 control-label">Mobile</label>
                                    <div class="col-md-4">
                                        <input value="<?php if(isset($_POST['user'])) echo $_POST['user'];?>" name="user" id="user" placeholder="Mobile"  required="" type="text" class="form-control">
                                        <span class="toolTip hide" title="Enter your username">&nbsp;</span>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Password</label>
                                    <div class="col-md-4">
                                        <input value="" name="password" id="password" placeholder="Password"  required="" type="Password" class="form-control">
                                        <span class="toolTip hide" title="Use atleast 6 characters">&nbsp;</span>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label for="cpassword" class="col-md-4 control-label">Confirm Password</label>
                                    <div class="col-md-4">
                                        <input value="" name="cpassword" id="cpassword" placeholder="Confirm Password"  required="" type="Password" class="form-control">
                                        <span class="toolTip hide" title="Confirm your password">&nbsp;</span>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label for="qualification" class="col-md-4 control-label">Qualification</label>
                                    <div class="col-md-8">
                                        <div class="col-md-3 padding-left">
                                            <select name="qul" id="qul" class="form-control" onchange="print_qual_sub('qual_sub',this.selectedIndex);">
                                            </select>
                                            <script type="text/javascript">print_quly("qul");</script>
                                        </div>    
                                        <div class="col-md-3 padding-left">    
                                            <select class="form-control" name="qual_sub" id="qual_sub" disabled>
                                            </select>
                                        </div>    
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <input type="checkbox" class="" id="terms" name="terms"> I Accept
                                        <a class="control-label" data-target="#myModalPrivacy" data-toggle="modal" href="#">Term & Conditions</a>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <div class="col-md-3 padding-left">
                                            <input type="button" name="sendOtp" id="sendOtp" value="Register" onclick="sendOTP(false)" class="btn btn-submit sb sb-btn"> 
                                        </div>
                                    </div>    
                                </div>
                                <input type="hidden" value="" name="resultOTP" id="resultOTP">
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- #content -->
    </div>
    <!-- #primary -->
</div>
<style>
    .sb-btn{
        width: 100%;
    }
    .padding-left{
        padding-left: 0px;
    }
    .resendotp{
        display: block;
        margin: 7px auto;
    }
</style>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";


    
     $(document).ready(function(){
       $("#sendOtpForm").validate({
        rules:{
            user:{
                required:true,
                minlength:10,
                maxlength:10,
                digits: true

            },
            password:{
                required:true,
                minlength:6,
                maxlength:15
            },
            cpassword:{
                required:true,
                minlength:6,
                maxlength:15,
                equalTo:'#password'
            },
            qul:{
              required:true
            },
            qual_sub:{
                required:true
          },
          terms:{
            required:true
          }
    },
    messages:{
        user:{
            required:'Enter Your Mobile Number',
            minlength:'Mobile Number Should be only numbers'
        },
        password:{
            required:'Enter Password',
            minlength:'Minimun 6 and Maximum 15 characters is required'
        },
        cpassword:{
            required:'Enter Confirm Password',
            minlength:'Minimun 6 and Maximum 15 characters is required',
            equalTo:'Password and confirm password should be equal'    
        },
        qul:{
            required:'Select the qualification'
        },
        qual_sub:{
            required:'Select the qualification'
        },
        terms:{
            required:'Accept terms and conditions'
        }
}
       });
});

// $('#terms').click(function(){
//             var checked_status = this.checked;
//             if (checked_status == true) {
//                $("#register").removeAttr("disabled");
//             } 
//             else {
//                $("#register").attr("disabled", "disabled");
//             }
//         });
  </script>
<!-- #main-content -->

<?php get_footer();?>
