<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sample
 */
$copy = ot_get_option('copyright');
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer " role="contentinfo">
		<div class="container">
			<div class="col-md-4 pull-left">
				<?php bloginfo('name');  ?> - &copy; <?php echo date('Y'); ?>
            </div>
			<div class="col-md-4 pull-right">
                <div style="float:right;"><span><a href="#" data-target="#myModal" data-toggle="modal"> Copyright </a></span></div>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog" style="color: #000">
                    <div class="modal-dialog modal-lg" >

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">CopyRights</h4>
                            </div>
                            <div class="modal-body">
                                <p><?php echo esc_textarea(get_option('piracy_term_conditions'))?></p>
                            </div>
                            <div class="modal-footer">
                                <label><input type="checkbox" class="" data-dismiss="modal"> Accept Term & Conditions</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="myModalPrivacy" class="modal fade" role="dialog" style="color: #000">
                    <div class="modal-dialog modal-lg" >

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">CopyRights</h4>
                            </div>
                            <div class="modal-body">
                                <p><?php echo esc_textarea(get_option('terms_conditions'))?></p>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>

                    </div>
                </div>
			</div>
		</div>
	</footer>
	
</div>

<?php wp_footer(); ?>
<script type="text/javascript">
	var $ = jQuery.noConflict();

$(function () {

    $('.toggle').click(function (event) {
        event.preventDefault();
        var target = $(this).attr('href');
        $(target).toggleClass('hidden show');
           
    });

});


</script>
<style type="text/css">
	.office
{
    display: none;
}	
</style>
<script type="text/javascript">
	$( ".blue-color" ).eq( 5 ).after('<div class="clearfix"></div>')


		$('.toggle').each(function(index){

		if(((index+1)%3)==0){
			$(this).after('<span class="clear"></span>');
		}

		});
		
        
        

</script>
<script>

$(document).ready(function () {
 //$('.office-title').next('div').slideToggle();
 $('.office-title').click(function(){   
 $('.office-title').next('div').slideUp();
     $(this).next('div').toggle(); 
     return false;
});
     });


$(document).ready(function () {
$('.xoxo li ').addClass('side-box');
});





$('#qul').change(function () {
    if(this.value == -1){
        $('#qual_sub').prop("disabled",true);
    }
    else {
        $('#qual_sub').prop("disabled",false);
    }

});

$(document).ready(function(){
  $('input[type="file"]').change(function(e){
    var fileSize = parseFloat(e.target.files[0].size / 1024).toFixed(2);
        if(fileSize >= 120){
           $("#fileupload").after("<span style='color:red'>File size should be less than 120 KB</span>");
        }
    });
});
</script>

</body>
</html>
