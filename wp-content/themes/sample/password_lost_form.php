<?php
/*
*Template Name:Forgot Password
*/




get_header();
?>

<div id="password-lost-form" class="widecolumn">
    <?php if ( $attributes['show_title'] ) : ?>
        <h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
    <?php endif; ?>
    <div class="col-md-12">
        <form id="lostpasswordform" action="<?php echo add_query_arg('do', 'forgot', get_permalink( $post->ID )); ?>" method="post">
            <div class="col-md-12 text-center">
                <p>Enter your registered mobile number and we'll send you password.</p>
            </div>  
            <div class="form-group">
                <label class="control-label col-md-4" for="email">Mobile Number</label>
              <div class="col-md-4">
                <input type="text" name="user_login" id="user_login" class="form-control">
              </div>
            </div>
            <div class="form-group">        
              <div class="col-md-offset-3 col-md-4">
                <input type="submit" name="submit" class="lostpassword-button btn btn-submit sb sb-btn1" name="lostPassword" value="Send Password"/>
              </div>
            </div>
            <div class="form-group">
                <?php if(defined('FORGOT_ERROR')){
                    foreach(unserialize(FORGOT_ERROR) as $error){
                        echo '<p class="order_error text-center" style="color:red;">'.$error.'</p><br>';
                    }
                }
                ?>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
.control-label{
    padding-top: 7px;
    text-align: right;  
    margin-bottom: 0;
}
</style>
<?php get_footer();?>