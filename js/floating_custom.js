jQuery(document).ready(function($){ 
 $('#fl_to_top').click(function(){
   $('html, body').animate({scrollTop:0}, 'slow');
 });
  $('#fl_to_bottom').click(function(){
   $("html, body").animate({ scrollTop: $(document).height() }, "slow");
 });
 });