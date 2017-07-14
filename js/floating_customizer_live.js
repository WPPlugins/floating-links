
/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	//Icon left
	wp.customize( 'floating_left', function( value ) {
		
		value.bind( function( newval ) {
			//console.log(newval);
			//$('.floating_next_prev_wrap .floating_links .fl_left_icon');
			if($('.fl_left_icon').hasClass('disabled')){
				//alert('hello');

					if(newval.indexOf("dashicons") > -1){
					$('.floating_next_prev_wrap .floating_links .fl_left_icon').removeAttr('class').addClass("fl_left_icon disabled " + newval);
						}
					else{
					$('.floating_next_prev_wrap .floating_links .fl_left_icon').removeAttr('class').addClass("fl_left_icon fa  disabled  fa-" + newval);
					}	
			
			}
			else if(newval.indexOf("dashicons") > -1){
				$('.floating_next_prev_wrap .floating_links .fl_left_icon').removeAttr('class').addClass("fl_left_icon  " + newval);
			}
			else{
				$('.floating_next_prev_wrap .floating_links .fl_left_icon').removeAttr('class').addClass("fl_left_icon fa  fa-" + newval);
			}
			
			

		} );
	} );

	//Icon right
	wp.customize( 'floating_right', function( value ) {
		
		value.bind( function( newval ) {
			if($('.fl_right_icon').hasClass('disabled')){
				//alert('hello');

					if(newval.indexOf("dashicons") > -1){
					$('.floating_next_prev_wrap .floating_links .fl_right_icon').removeAttr('class').addClass("fl_right_icon disabled " + newval);
						}
					else{
					$('.floating_next_prev_wrap .floating_links .fl_right_icon').removeAttr('class').addClass("fl_right_icon fa  disabled  fa-" + newval);
					}	
			
			}
			else if(newval.indexOf("dashicons") > -1){
				$('.floating_next_prev_wrap .floating_links .fl_right_icon').removeAttr('class').addClass("fl_right_icon  " + newval);
			}
			else{
				$('.floating_next_prev_wrap .floating_links .fl_right_icon').removeAttr('class').addClass("fl_right_icon fa  fa-" + newval);
			}
			
		} );
	} );


	//Icon Random
	wp.customize( 'floating_random', function( value ) {
		
		value.bind( function( newval ) {
				if(newval.indexOf("dashicons") > -1){
					$('.floating_next_prev_wrap .floating_links .fl_random_icon').removeAttr('class').addClass("fl_random_icon " + newval);
						}
					else{
					$('.floating_next_prev_wrap .floating_links .fl_random_icon').removeAttr('class').addClass("fl_random_icon fa fa-" + newval);
					}	
			
		} );
	} );

	//Icon top
	wp.customize( 'floating_up', function( value ) {
		
		value.bind( function( newval ) {
		if(newval.indexOf("dashicons") > -1){
		$('.floating_next_prev_wrap .floating_links .fl_top_icon').removeAttr('class').addClass("fl_top_icon " + newval);
		}
		else{
			$('.floating_next_prev_wrap .floating_links .fl_top_icon').removeAttr('class').addClass("fl_top_icon fa  fa-" + newval);
		}	
		} );
	} );

	//Icon bottom
	wp.customize( 'floating_down', function( value ) {
		
		value.bind( function( newval ) {
			//console.log(newval);
			//$('.floating_next_prev_wrap .floating_links .fl_left_icon');
		if(newval.indexOf("dashicons") > -1){	
		$('.floating_next_prev_wrap .floating_links .fl_bottom_icon').removeAttr('class').addClass("fl_bottom_icon " + newval);
		}
		else{
			$('.floating_next_prev_wrap .floating_links .fl_bottom_icon').removeAttr('class').addClass("fl_bottom_icon fa  fa-" + newval);
		}

		} );
	} );

	//Update Bg color in real time...
	wp.customize( 'jws_floating_c_bg_color', function( value ) {
		
		value.bind( function( newval ) {
			$('.floating_next_prev_wrap .floating_links .disabled, .floating_next_prev_wrap .floating_links a').css('background-color', newval);
		} );
	} );

	//Update Bg color in real time...
	wp.customize( 'jws_floating_c_h_bgcolor', function( value ) {
		
		value.bind( function( newval ) {
			$('<style>.floating_next_prev_wrap .floating_links a:hover{background-color:' + newval + ' !important;}</style>').appendTo('head');
		} );
	} );

	
	//Update site link color in real time...
	wp.customize( 'jws_floating_c_color', function( value ) {
		value.bind( function( newval ) {
			$('.floating_next_prev_wrap .floating_links .disabled, .floating_next_prev_wrap .floating_links a').css('color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'jws_floating_c_h_color', function( value ) {
		value.bind( function( newval ) {
			$('<style>.floating_next_prev_wrap .floating_links a:hover{color:' + newval + ' !important;}</style>').appendTo('head');
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'jws_floating_c_size', function( value ) {
		value.bind( function( newval ) {
			$('.floating_next_prev_wrap .floating_links .disabled, .floating_next_prev_wrap .floating_links a').css('font-size', newval + 'px' );
		} );
	} );

	//Update Bg color in real time...
	wp.customize( 'jws_floating_c_b_color', function( value ) {
		
		value.bind( function( newval ) {
			$('.floating_next_prev_wrap .floating_links .disabled, .floating_next_prev_wrap .floating_links a').css('border-color', newval);
		} );
	} );
	
	//Update Bg color in real time...
	wp.customize( 'jws_floating_c_shadow', function( value ) {
		
		value.bind( function( newval ) {
			
			if(newval == false){
				newval = 'none';
			}
			else 
			{
				newval =  '-6px 4px 20px 0px rgba(0,0,0,0.75)';
			}
			$('.floating_next_prev_wrap .floating_links').css('box-shadow', newval);
		} );
	} );

} )( jQuery );
