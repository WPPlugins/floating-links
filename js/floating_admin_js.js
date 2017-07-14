jQuery( document ).ready(function($) {

	
	jQuery(document).on("click", "#customize-control-floating_left .jws_floating_bg_holder", function($) {
		jQuery('#customize-control-floating_left .jws_floating_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-floating_right .jws_floating_bg_holder", function($) {
		jQuery('#customize-control-floating_right .jws_floating_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-floating_random .jws_floating_bg_holder", function($) {
		jQuery('#customize-control-floating_random .jws_floating_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-floating_up .jws_floating_bg_holder", function($) {
		jQuery('#customize-control-floating_up .jws_floating_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-floating_down .jws_floating_bg_holder", function($) {
		jQuery('#customize-control-floating_down .jws_floating_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	
jQuery(document).on("click", ".fl_flip_btn", function($) {
		
		jQuery(this).next().toggleClass('flipped');
		
 });

if(jQuery('#enable_random').is(":checked")) {
		        jQuery('#enable_random').next().addClass('checked');
		    }	

	if(jQuery('#enable_np').is(":checked")) {
		        jQuery('#enable_np').next().addClass('checked');
		    }
	if(jQuery('#enable_top').is(":checked")) {
		        jQuery('#enable_top').next().addClass('checked');
		    }

	if(jQuery('#enable_bottom').is(":checked")) {
		        jQuery('#enable_bottom').next().addClass('checked');
		    }		    		    

 });	