    <?php
    /**
     * Created by PhpStorm.
     * User: Raja
     * Date: 18-Dec-16
     * Time: 11:13 PM
     * Template Name:Subscription Page
     */
    $user_Id = $_GET['userid'];
    $resultOTP = $_GET['resultOTP'];
    $order_id = time() . $user_Id;
    get_header();?>

    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <div class="container">
                    <div class="col-md-12">
                        <?php 
                            if(empty($resultOTP)){
                                echo '<p style="color:red;text-align:center;">'.'Your Account is inactive due to incomplete payment.
                                Please Make Payment To Complete Registration Process'.'</p>';    
                            }
                        ?>
                        <h3>Confirm Details</h3>
                        <div class="col-md-6">
                            <h4>User Details</h4>
                            <?php
                            $current_user = get_user_by('ID',$user_Id);
                            
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="paymentdetails">Username</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="paymentdetails" id="username"><?php echo $current_user->user_login;?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="paymentdetails">Display Name</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="paymentdetails"><?php echo $current_user->display_name?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="paymentdetails">Qualification</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="paymentdetails"><?php echo $current_user->qulification ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="paymentdetails">Subqulification</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="paymentdetails"><?php echo $current_user->subqualification ?></p>
                                </div>    
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <h4>Payment Details</h4>
                            <p class="paymentdetails">
                                <?php $price = get_option('s_price');?>
                                <?php $tax = get_option('s_tax');?>
                            </p>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="paymentdetails">Subscription Plan Amount</p>
                                </div>
                                <div class="col-md-2">
                                    <p class="paymentdetails"><i class="fa fa-inr" aria-hidden="true"></i>  <?php echo $price?></p>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="paymentdetails">
                                        Tax Amount
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <i class="fa fa-inr" aria-hidden="true"></i>  <?php echo $tax;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="paymentdetails paymentbold">
                                        <?php $total = $price + $tax;?>
                                        Total Amount To Pay 
                                    </p>
                                </div>
                                <div class="col-md-2 paymentbold">
                                    <i class="fa fa-inr" aria-hidden="true"></i>  <?php echo $total; ?>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 margint-30">

                    </div>
                    <div class="col-md-9">
                        <div class="pm-button pull-right">
                            <form method="post" name="customerData" id="customerData" action="<?php echo site_url('/transaction/') ?>">
                              <input type="hidden" name="merchant_id" value="124288">
                              <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
                              <input type="hidden" name="currency" value="INR">
                              <input type="hidden" name="amount" value="<?php echo $total ?>">
                              <input type="hidden" name="redirect_url" value="<?php echo esc_url(add_query_arg('do', 'payment_success', site_url('/payment-success/'))) ?>">
                              <input type="hidden" name="cancel_url" value="<?php echo site_url('/payment-cancel/');?>">
                              <input type="hidden" name="userId" value="<?php echo $user_Id?>">
                              <input type="hidden" name="billing_name" value="<?php echo $current_user->user_login?>"> 
                              <input type="hidden" name="qualification" value="<?php echo $current_user->qulification ?>">
                              <input type="hidden" name="sub_qual" value="<?php echo $current_user->subqualification ?>">
                              <input type="hidden" name="resultOTP" id="resultOTP" value="<?php echo $resultOTP?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" style="margin-bottom:0px;">
                            <div class="col-md-8 col-md-push-4">
                                <?php if(!empty($resultOTP) && !empty($user_Id)){?>
                                    <div class="col-md-3 padding-left">
                                        <input type="text" name="gotp" id="gotp" class="form-control" placeholder="Enter OTP">
                                    </div>
                                     <div class="col-md-3 padding-left" style="margin-top:6px;">
                                        <a href="#" class="resendotp" onclick="sendOTP(true)">Resend OTP</a>
                                    </div>        
                                    <div class="col-md-2">
                                        <p id="InvalidOtp"></p>
                                     </div>    
                                <?php }?>     
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <div class="col-md-3 padding-left">
                                            <a href="<?php echo site_url('/register/')?>" class="btn btn-submit sb sb-btn1" id="back" name="back" style="height:40px;">Back</a>
                                            <input type="button" name="back" id="back" value="Back" class="btn btn-submit sb sb-btn1 hide"> 
                                        </div>
                                        <div class="col-md-3 padding-left">    
                                            <input name="makepayment" type="button" class="btn btn-submit sb sb-btn1" value="Makepayment" id="makepayment"  onclick="verifyOTP()">
                                        </div>    
                                    </div>    
                                </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
    .paymentdetails{
        font-size: 15px;
    }
    .paymentbold{
        font-weight: bold;
    }
    .margint-30{
        height: 30px;
    }
    .sb-btn1{
        width: 100%;
    }

    
    </style>
    <script type="text/javascript">
        
    </script>
    <?php get_footer();?>