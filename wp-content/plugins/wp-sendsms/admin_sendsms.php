<?php
global $wpdb;

?>
<div class="wrap">

    <div id="icon-options-general" class="icon32"><br></div>

    <h2>Send SMS</h2>

    <p>Here you can send sms to any number. This can be used for promotion, Customer notification, Information passing etc.</p>

    <?php global $admin_sms_response;  if($admin_sms_response != '') { ?>

    <div id="message" class="updated"><p><?php echo $admin_sms_response; 

    $admin_sms_response=''; ?></p></div>

    <?php } ?>

    <form action="" method="post" id="wp-sms-form" role="form" class="form-horizontal">
        <div class="col-md-12">
            <div class="form-group">
                <label for="qualification" class="col-md-4 control-label">Qualification</label>
                <div class="col-md-4 padding-left">
                    <select name="qul" id="qul" class="form-control" onchange="print_qual_sub('qual_sub',this.selectedIndex);">
                    </select>
                    <script type="text/javascript">print_quly("qul");</script>
                </div>    
            </div>
            <div class="form-group">
                <label for="qualification" class="col-md-4 control-label">Category</label>
                <div class="col-md-4 padding-left">    
                <select class="form-control" name="qual_sub" id="qual_sub" disabled onchange="print_name(this)">
                </select>
            </div>    
            </div>
            
            <div class="form-group" id="output1">
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Message</label>
                <div class="col-md-4">
                 <textarea name="adminmessage" id="adminmessage" rows="5" cols="50"><?php echo $_SESSION['adminmessage'] ?></textarea><?php if(get_option('remove_bad_words')) {

                  echo "<p>Note: Bad Words in the message will be removed</p>";
                  echo "<p id='textarea_feedback'></p>";
              } ?>

          </div>
          <div ></div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
            <input type="submit" id="submit" value="Send SMS" class="btn btn-primary"/> 
        </div>
      </div>
  </div>

  <?php wp_nonce_field('admin_send_sms','admin_send_sms_nonce'); ?>

</form>

</div>

<script type="text/javascript">

function print_name(sel){

        //var ajaxurl = <?php plugin_dir_url(__FILE__ ).'include/fetch_user_list.php';?>

        //console.log(ajaxurl);

        $("#output1").html("");

        var qual_sub = sel.options[sel.selectedIndex].value;

        console.log(qual_sub);

        var url="<?php echo plugin_dir_url(__FILE__).'include/fetch_user_list.php'?>";

        //alert(url);

        if(qual_sub.length>0){

            $.ajax({

                type:"POST",

                url:url,

                data:"cat_id="+qual_sub,

                cache:false,

                success:function(html){
                	console.log(html)
                    $("#output1").html(html);

                }



            });

        }

    }
    var $ = jQuery.noConflict();
    $('#qul').change(function () {
        if(this.value == -1){
            $('#qual_sub').prop("disabled",true);
        }
        else {
            $('#qual_sub').prop("disabled",false);
        }

    })

    $(document).ready(function() {
        var text_max = 160;
        $('#textarea_feedback').html(text_max + ' characters remaining');

        $('#adminmessage').keyup(function() {
            var text_length = $('#adminmessage').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining');
        });
    });
    </script>