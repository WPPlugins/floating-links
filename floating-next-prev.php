<?php 
/*
Plugin Name: Floating Links
Plugin URI: https://wordpress.org/plugins/floating-links/
Description: Displays fancy floating top bottom and next post previous post links with custom post types support.
Author: JWebSol
Version: 1.2.3
Author URI: https://jwebsol.com/
*/ 

								//======================================================================
													// Floating links Class 
								//======================================================================
								
class Floating_Links{

		public $version = '1.2.3';

		// __construct will call the actions on class call.
		function __construct(){
			 add_action('init', array($this, 'constants'));
			add_action( 'wp_enqueue_scripts', array($this, 'jws_floating_style') );
			add_action( 'wp_footer', array($this, 'jws_floating_func' ) );
			add_action('init', array($this, 'includes'));
			register_activation_hook( __FILE__,  array($this , 'jws_floating_activate'));
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array ($this , 'jws_floating_s_link'));
		}
			
		// jws_floating_style method will call stlying and jquery file.
			
		public function jws_floating_style() {
			wp_enqueue_style('floating_style', plugin_dir_url( __FILE__ ) . '/css/floating_style.css' );
			wp_enqueue_style('floating_fonts', plugin_dir_url( __FILE__ ) . '/css/floating_fonts.css' );
			wp_enqueue_script( 'floating_custom', plugin_dir_url( __FILE__ ) . 'js/floating_custom.js', array( 'jquery' ) );
			wp_enqueue_style( 'dashicons' );
		}
		
		
		
		//iclude necessary files
			public function includes() {
			include (  plugin_dir_path( __FILE__ ) . 'admin/admin.php');	
			include (  plugin_dir_path( __FILE__ ) . 'admin/customizer-extend.php');
			include (  plugin_dir_path( __FILE__ ) . 'admin/customizer.php');
		}

		 public function constants() {



		// Plugin version

		if ( ! defined( 'JWS_FLOATING_VERSION' ) ) {

			define( 'JWS_FLOATING_VERSION', $this->version );

		}



		// Plugin Folder Path

		if ( ! defined( 'JWS_FLOATING_DIR' ) ) {

			define( 'JWS_FLOATING_DIR', plugin_dir_path( __FILE__ ) );

		}



		// Plugin Folder URL

		if ( ! defined( 'JWS_FLOATING_URL' ) ) {

			define( 'JWS_FLOATING_URL', plugin_dir_url( __FILE__ ) );

		}



		// Plugin Root File

		if ( ! defined( 'JWS_FLOATING_FILE' ) ) {

			define( 'JWS_FLOATING_FILE', __FILE__ );

		}

	}

	// Update options by default
	public function jws_floating_activate(){

				$install_date = get_option( 'jws_floating_installDate' );
				update_option('jws_floating_version', $this->version);
				if(  $install_date == '' && $install_date != '1'){
					update_option('jws_floating_random', 'on');
					update_option('jws_floating_np', 'on');
					update_option('jws_floating_top', 'on');
					update_option('jws_floating_bottom', 'on');
					update_option( 'jws_floating_c_shadow', '1' );
					add_option( 'jws_floating_installDate', date( 'Y-m-d h:i:s' ) );
				}
			  if(!empty($install_date)):
					
			  		$left_icon = get_theme_mod( 'floating_left');
					$right_icon = get_theme_mod( 'floating_right');
					$random_icon = get_theme_mod( 'floating_random');
					$top_icon = get_theme_mod( 'floating_up');
					$bottom_icon = get_theme_mod( 'floating_down');

					$bg_color = get_theme_mod('jws_floating_c_bg_color');
					$color = get_theme_mod('jws_floating_c_color');
					$size = get_theme_mod('jws_floating_c_size');
					$bcolor = get_theme_mod('jws_floating_c_b_color');
					$hbcolor = get_theme_mod('jws_floating_c_h_bgcolor');
					$hcolor = get_theme_mod('jws_floating_c_h_color');
					$shadow = get_theme_mod('jws_floating_c_shadow');
					
					if(!empty($bg_color)):
					update_option('floating_left', $left_icon);
					update_option('floating_right', $right_icon);
					update_option('floating_random', $random_icon);
					update_option('floating_up', $top_icon);
					update_option('floating_down', $bottom_icon);

					update_option('jws_floating_c_bg_color', $bg_color);
					update_option('jws_floating_c_color', $color);
					update_option('jws_floating_c_size', $size);
					update_option('jws_floating_c_b_color', $bcolor);
					update_option('jws_floating_c_h_bgcolor', $hbcolor);
					update_option('jws_floating_c_h_color', $hcolor);
					update_option('jws_floating_c_shadow', $shadow);
				endif;	

					remove_theme_mod( 'floating_left' );
					remove_theme_mod( 'floating_right');
					remove_theme_mod( 'floating_random');
					remove_theme_mod( 'floating_up');
					remove_theme_mod( 'floating_down');
					remove_theme_mod('jws_floating_c_bg_color');
					remove_theme_mod('jws_floating_c_color');
					remove_theme_mod('jws_floating_c_size');
					remove_theme_mod('jws_floating_c_b_color');
					remove_theme_mod('jws_floating_c_h_bgcolor');
					remove_theme_mod('jws_floating_c_h_color');
					remove_theme_mod('jws_floating_c_shadow');
			  	endif;	
	}	
		//Get the random post
			public function jws_random_post(){
				$post_type = get_post_type();
				$rand = get_posts(array('posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => $post_type));
				$rand_url = get_permalink($rand[0]->ID);
				return $rand_url;
				}
				
		// jws_floating_func method will perform the functionality for floating posts and up and down page.
		
		public function jws_floating_func( $content ) {
			
					$enable_random = get_option('jws_floating_random', true);
					$enable_np = get_option('jws_floating_np', true);
					$enable_top = get_option('jws_floating_top', true);
					$enable_bottom = get_option('jws_floating_bottom', true);

					$left_icon = get_option( 'floating_left');
					$right_icon = get_option( 'floating_right');
					$random_icon = get_option( 'floating_random' );
					$top_icon = get_option( 'floating_up');
					$bottom_icon = get_option( 'floating_down');
					if($left_icon == '' or $left_icon =='1'):
					$left_icon = 'dashicons dashicons-arrow-left-alt';
					endif;
					if($right_icon == '' or $right_icon =='1'):
						$right_icon = 'dashicons dashicons-arrow-right-alt';
					endif;	
					if($random_icon == '' or $random_icon =='1'):
						$random_icon = 'dashicons dashicons-randomize';
					endif;	
					
					if($enable_np == 'on' && $enable_np != '1'):
						if (strpos($right_icon, 'dashicons') !== false) { 

					$next_post = get_next_post_link('%link', '<i title="Next post" class="fl_right_icon '.$right_icon.'"></i>');
					
						}
						else{
						$next_post = get_next_post_link('%link', '<i title="Next post" class="fl_right_icon fa fa-'.$right_icon.'"></i>');
						}
			
					endif;
					if($enable_random == 'on' && $enable_random != '1'):
						if (strpos($random_icon, 'dashicons') !== false) { 

						$random_post = '<a  title="Random post" href="'.$this->jws_random_post().'"><i class="fl_random_icon '.$random_icon.'"></i></a>';
						}
						else{
							$random_post = '<a  title="Random post" href="'.$this->jws_random_post().'"><i class="fl_random_icon fa 
							fa-'.$random_icon.'"></i></a>';
						}
					
					endif;
					if($enable_np == 'on' && $enable_np != '1'):
						if (strpos($left_icon, 'dashicons') !== false) { 

					$prev_post = get_previous_post_link('%link', '<i title="Previous post" class="fl_left_icon '.$left_icon.'">
					</i>');
						}
						else{
						$prev_post = get_previous_post_link('%link', '<i title="Previous post" class="fl_left_icon fa fa-'.$left_icon.'">
					</i>');
						}

					endif;

				if(empty($next_post)){
					if($enable_np == 'on' && $enable_np != '1'):
						if (strpos($right_icon, 'dashicons') !== false) { 

					$next_post = '<i title="Next post" class="fl_right_icon '.$right_icon.' disabled" aria-hidden="true"></i>';
				
						}
						else{
						$next_post = '<i title="Next post" class="fl_right_icon fa fa-'.$right_icon.' disabled" aria-hidden="true"></i>';			
						}
					endif;	
					}
				if(empty($prev_post)){
					if($enable_np == 'on' && $enable_np != '1'):
						if (strpos($left_icon, 'dashicons') !== false) { 
					$prev_post ='<i  title="Previous post" class="fl_left_icon '.$left_icon.' disabled" aria-hidden="true"></i>';
						}
						else{
					$prev_post = '<i  title="Previous post" class="fl_left_icon fa fa-'.$left_icon.' disabled" aria-hidden="true"></i>';	
						}
						endif;
					}	
				
					$content .= '<div class="floating_next_prev_wrap">
					
							<div class="floating_links">';

							 if (is_single()) {
								$content .= '
								'.$next_post.'
								'.$prev_post.'
								'.$random_post.'';
								}
				if($top_icon == ''):
					$top_icon = 'dashicons dashicons-arrow-up-alt';
				endif;
				if($bottom_icon == ''):
					$bottom_icon = 'dashicons dashicons-arrow-down-alt';
				endif;	

					if($enable_top == 'on' && $enable_top != '1'):	
						if (strpos($top_icon, 'dashicons') !== false) {	
						$content .= '<a title="Go to top" href="#" id="fl_to_top"><i class="fl_top_icon '.$top_icon.'" aria-hidden="true"></i></a>';
						}
						else{
						$content .= '<a title="Go to top" href="#" id="fl_to_top"><i class="fl_top_icon fa fa-'.$top_icon.'" aria-hidden="true"></i></a>';	
						}

					endif;
					if($enable_bottom == 'on' && $enable_bottom != '1'):
						if (strpos($bottom_icon, 'dashicons') !== false) {		
								$content .= '<a title="Go to bottom" href="#" id="fl_to_bottom"><i class="fl_bottom_icon '.$bottom_icon.'" aria-hidden="true"></i></a>';
						}
						else{
								$content .= '<a title="Go to bottom" href="#" id="fl_to_bottom"><i class="fl_bottom_icon fa fa-'.$bottom_icon.'" aria-hidden="true"></i></a>';
						}		
					endif;		
							$content .= '</div>		
					
							
							</div>';
    
	
						echo $content;	
				}

		public function jws_floating_s_link ( $links ) {
		 $mylinks = array(
		 '<a href="' . admin_url( 'admin.php?page=jws_floating_setting' ) . '">Settings</a>',
		 );
		return array_merge($mylinks, $links);
		}
	
			
	} // End Class								
$floting_links = new Floating_Links();