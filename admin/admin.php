<?php

// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) exit;



								//======================================================================

													// Admin Area Of Floating Links

								//======================================================================

class Jws_Floating_Admin {

	

		function __construct(){
			add_action('admin_menu', array($this,'jws_floating_menu'));
			add_action( 'jws_floating_render_tab_content_f_general', array($this,'jws_floating_tab_f_general' ));
			add_action( 'admin_enqueue_scripts', array($this, 'jws_floating_admin_style'));
			add_action( 'admin_notices', array ($this , 'post_installtion_upgrade_nag' )); 	
			add_action( 'wp_ajax_jws_floating_supported', array ($this , 'jws_floating_supported_func' ));	
			

		}


		// jws_floating_style method will call stlye file in admin area.
		public function jws_floating_admin_style($hook) {
			
			// Load only on ?page=mypluginname
       // if($hook == 'toplevel_page_jws_floating_setting') {
          
			wp_enqueue_style('floating_admin_style', JWS_FLOATING_URL . 'css/floating_admin_style.css' );
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_style('floating_fonts', JWS_FLOATING_URL . 'css/floating_fonts.css' );
			wp_enqueue_script( 'floating_admin_js', JWS_FLOATING_URL . 'js/floating_admin_js.js', array( 'jquery' ) );
       // }
        	
					
		}
		
		//jws_page_func method will add menu page for settings
		
		public function jws_floating_menu(){

		$icon_url = JWS_FLOATING_URL . '/images/plugin_icon.png';
		add_menu_page('Floating Links Settings', 'Floating Links', 'administrator', 'jws_floating_setting', array($this,'jws_page_func'),$icon_url );
	
		}
		

		// Genral Tab Content
		
		public	function jws_floating_tab_f_general(){

			
			if(isset($_POST['jws_floating_config_sub'])){
					
					update_option('jws_floating_random', $_POST['enable-random']);
					update_option('jws_floating_np', $_POST['enable-np']);
					update_option('jws_floating_top', $_POST['enable-top']);
					update_option('jws_floating_bottom', $_POST['enable-bottom']);
				
					}
					
					$enable_random = get_option('jws_floating_random', true);
					$enable_np = get_option('jws_floating_np', true);
					$enable_top = get_option('jws_floating_top', true);
					$enable_bottom = get_option('jws_floating_bottom', true);
			
			

			$returner = '<div class="tab_wraper">

				<div class="tab_wraper">
				<form class="jws_floating_config" method="post">

				<table class="form-table"><tbody>

				<tr><th scope="row">'.__('Enable Random Button.', 'jws_fl').'</th>

				<td>
				<input id="enable_random" type="checkbox" name="enable-random" value="on" class="fl_flip_btn"';
				 $checked = checked( $enable_random, 'on', false ); 
					$returner .= ''.$checked.'>
				<div class="fl_flip_holder">
  					<span class="front">No</span>
  					<span class="back">yes</span>

				</div>
				</td>

				<tr><th scope="row">'.__('Enable next previous button.', 'jws_fl').'</th>

				<td>
				<input id="enable_np" type="checkbox" name="enable-np" value="on" class="fl_flip_btn"';
				 $checked = checked( $enable_np, 'on', false ); 
					$returner .= ''.$checked.'> <div class="fl_flip_holder">
  					<span class="front">No</span>
  					<span class="back">yes</span>

				</div>
				</td>

				<tr><th scope="row">'.__('Enable bottom to top button.', 'jws_fl').'</th>

				<td>
				<input id="enable_top" type="checkbox" name="enable-top" value="on" class="fl_flip_btn"';
				 $checked = checked( $enable_top, 'on', false ); 
					$returner .= ''.$checked.'>
				<div class="fl_flip_holder">
  					<span class="front">No</span>
  					<span class="back">yes</span>

				</div>
				</td>

				<tr><th scope="row">'.__('Enable top to bottom button.', 'jws_fl').'</th>

				<td><input id="enable_bottom" type="checkbox" name="enable-bottom" value="on" class="fl_flip_btn"';
				 $checked = checked( $enable_bottom, 'on', false ); 
					$returner .= ''.$checked.'>
				<div class="fl_flip_holder">
  					<span class="front">No</span>
  					<span class="back">yes</span>

				</div>
				</td>
				
				<tr>

				<th><input type="submit" name="jws_floating_config_sub" id="jws_floating_config_sub" value="'.__('Save Changes', 'jws_fl').'"></th>

				</tr>

				</tbody>

				</table>

				</form>
			</div>	
			</div>	
				';

			echo $returner;	

			

			}	
			
			
		public function jws_page_func(){
			
			
			
			$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'f_general';

			

			if($active_tab == 'f_general'){

				$f_general =  'active';

				}	
				
				
			$returner = '';
			$returner = '<div class="jws_floating_wrap"> 
					
					<div class="jws_floating_header">

					<span class="main_i">

							<i class="line"></i>

							<span class="botn botn_1 Linear_1"> </span>

							<i class="line"></i>

							<span class="botn botn_2 Linear_2"> </span>

							<i class="line"></i>

							<span class="botn botn_3 Linear_1"> </span>

					</span>	

							

					<h2 class="jws-floating-settings-title">

					Fancy Floating Links</h2></div>

			<div class="jws-floating-tab-container slideLeft">

			<ul id="sortable-units" class="jws-floating-tabs" style="">

				<li class="jws-floating-tab'; if(isset($f_general)){ 

									$returner .= ' '.$f_general.'';

									}

									$returner .= '">

						

                <a href="'.admin_url('admin.php?page=jws_floating_setting&tab=f_general').'" class="jws-floating-tab-link">'.__('General', 'jws_fl').'</a>

					</li>

					

				<li class="jws-floating-tab '; 

									if(isset($f_design)){ 

									$returner .= ' '.$f_design.'';

									}
									$recent_posts = wp_get_recent_posts( array ('posts_per_page' => 1) );
									$first_post_url = get_permalink($recent_posts[0][ID]);
									$c_post_url = urlencode($first_post_url);
									$c_post_url = 'customize.php?url=' . $c_post_url . '&autofocus[panel]=jws_floating_c_panel';
									$returner .= '">';
									
									
							$returner .= '<a href="'.admin_url($c_post_url).'" class="jws-floating-tab-link">'.__('Design', 'jws_fl').'</a>
	
						</li>';
					

					ob_start();

					

					do_action('jws_floating_tab_nav');

					

					$returner .= ob_get_clean();				

							$returner .= '</ul>

		</div>';
		

$returner .= '<div class="jws-floating-settings jws-floating-settings-genral SlideRight">

			<div class="jws-floating-settings-genral-wrapper">';
			
			
		

			ob_start();
		
		 do_action('jws_floating_render_tab_content_'.$active_tab);
	
			
					$returner .= ob_get_clean();


			$returner .= '</div>

			</div>
			<div class="jws_floating_support_sec">
					<div class="jws_floating_s_wid fadeIn">
					<h3>'.__('Like our Facebook fan page to stay updated', 'jws_fl').'</h3>
						<div class="fb-page" 
  data-href="https://www.facebook.com/jwebsol"
  data-width="380" 
  data-hide-cover="false"
  data-show-facepile="false" 
  data-show-posts="false"></div>
					<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
					</div>

					<div class="jws_floating_s_wid fadeIn">
					<h3>'.__('Follow me on Twitter for WP Wisdom', 'jws_fl').'</h3>
						<a href="https://twitter.com/SajidJavaid" class="twitter-follow-button" data-show-count="false">Follow @SajidJavaid</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>
				</div>

				<div class="jws_floating_s_wid fadeIn">
					<h3>'.__('Like it? Then give us 5 star rating here:', 'jws_fl').'</h3>
						<a href="https://wordpress.org/support/plugin/floating-links/reviews/?filter=5#new-post" class="button button-primary"  target="_new">'.__('Rate it here', 'jws_fl').'</a>
				</div>

				
				<div class="jws_floating_s_wid fadeIn">
					<h3>'.__('Any question? Don’t hesitate to create a support ticket here:', 'jws_fl').'</h3>
						<a href="https://wordpress.org/support/plugin/floating-links/" class="button button-primary"  target="_new">'.__('Open support ticket', 'jws_fl').'</a>
				</div>
				
			</div>';

			

echo $returner;	
			
		}

			/**
	 * Display a thank you nag when the plugin has been installed/upgraded.
	 */
	public function post_installtion_upgrade_nag() { 
 		if ( !current_user_can('install_plugins') ) return;


	$install_date = get_option( 'jws_floating_installDate' );
    $display_date = date( 'Y-m-d h:i:s' );

    $datetime1 = new DateTime( $install_date );
    $datetime2 = new DateTime( $display_date );
    $diff_intrval = round( ($datetime2->format( 'U' ) - $datetime1->format( 'U' )) / (60 * 60 * 24) );
		if ( $diff_intrval >= 7 && get_site_option( 'jws_floating_support' ) != "yes" ) {
				
		
			$html = sprintf(
					    '<div class="update-nag jws_floating_msg">
					    <p>%s<b>%s</b>%s</p>
					    <p>%s<b>%s</b>%s</p>
					    <p>%s</p>
					    <br>
					    <p>%s</p>
					   ~Sajid Javed (sjaved)
					   <div class="jws_floating_support_btns">
					<a href="https://wordpress.org/support/plugin/floating-links/reviews/?filter=5#new-post" class="jws_floating_HideRating button button-primary" target="_blank">
						%s	
					</a>
					<a href="javascript:void(0);" class="jws_floating_HideRating button" >
					%s	
					</a>
					<br>
					<a href="javascript:void(0);" class="jws_floating_HideRating" >
					%s	
					</a>
					    </div>
					    </div>',
					    __( 'Awesome, you have been using ', 'jws_fl' ),
					    __( 'Floating Links ', 'jws_fl' ),
					    __( 'for more than 1 week.', 'jws_fl' ),
					     __( 'May I ask you to give it a ', 'jws_fl' ),
					     __( '5-star ', 'jws_fl' ), 
					     __( 'rating on Wordpress? ', 'jws_fl' ), 
					     __( 'This will help to spread its popularity and to make this plugin a better one.', 'jws_fl' ),
					    __( 'Your help is much appreciated. Thank you very much. ', 'jws_fl' ),
					    __( 'I Like Floating Links - It increased engagement on my site', 'jws_fl' ),
					     __( 'I already rated it', 'jws_fl' ),
					    __( 'No, not good enough, I do not like to rate it', 'jws_fl' )
				  
					);
			$script = ' <script>
			    jQuery( document ).ready(function( $ ) {

			    jQuery(\'.jws_floating_HideRating\').click(function(){
			       var data={\'action\':\'jws_floating_supported\'}
			             jQuery.ajax({
			        
			        url: "' . admin_url( 'admin-ajax.php' ) . '",
			        type: "post",
			        data: data,
			        dataType: "json",
			        async: !0,
			        success: function(e ) {
			        	
			            if (e=="success") {
			             	jQuery(\'.jws_floating_msg\').slideUp(\'fast\');
						   
			            }
			        }
			         });
			        })
			    
			    });
    </script>';
		echo $html . $script;	
		} 	
		
 	}

 	public function jws_floating_supported_func(){
 		update_site_option( 'jws_floating_support', 'yes' );
 		echo json_encode( array("success") );
    		exit;
 	}

 	
									
}
$admin_holder = new Jws_Floating_Admin();