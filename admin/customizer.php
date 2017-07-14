<?php

// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) exit;



								//======================================================================

													// Settings in Customizer

								//======================================================================

class JWS_FLOATING_CUSTOMIZER {

	

		function __construct(){
			 add_action( 'customize_register', array ($this , 'jws_floating_customizer' )); 
			
			 add_action( 'wp_head', array($this, 'jws_floating_customizer_css') );
	
			 add_action( 'customize_preview_init', array ($this ,'jws_floating_live_preview'));		
		}

									

		function jws_floating_customizer( $wp_customize ) {

					
					$wp_customize->add_panel( 'jws_floating_c_panel', array(
							'capability' => '',
							'priority'	=> 10,
							'theme_supports' => '',
							'title' => __( 'Floating Links Settings', 'jws_fl' ),
							
						) );


					$wp_customize->add_section(

						'jws_floating_c_icons',

						array(

							'title' => __( 'Change icons ', 'jws_fl' ),

							'description' => __('Chose any icon from the list below and see the magic live.', 'jws_fl'),

							'priority' => 35,

							'panel' => 'jws_floating_c_panel',	
						
						)
					);

					$wp_customize->add_section(

						'jws_floating_c_design',

						array(

							'title' => __( 'Design', 'jws_fl' ),

							'description' => __('Customize design of your fancy floating links live.', 'jws_fl'),

							'priority' => 35,

							'panel' => 'jws_floating_c_panel',	
						
						)

				

					);


					$wp_customize->add_setting(
					'jws_floating_c_bg_color',
					array(
						'default' => '#fff',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);
				
				$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'jws_floating_c_bg_color',
					$this->cutomizer_values('Background colour.', 'jws_floating_c_design', 'jws_floating_c_bg_color', null)
					
			));


					$wp_customize->add_setting(
					'jws_floating_c_color',
					array(
						'default' => '#000',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);
					$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'jws_floating_c_color',
					$this->cutomizer_values('Icons colour.', 'jws_floating_c_design', 'jws_floating_c_color', null)
				
				));

			
				$wp_customize->add_setting(
					'jws_floating_c_h_color',
					array(
						'default' => '#fff',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);	
				
				$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'jws_floating_c_h_color',
					$this->cutomizer_values('Icons hover colour.', 'jws_floating_c_design', 'jws_floating_c_h_color', null)
			
				));

				

				$wp_customize->add_setting(
					'jws_floating_c_h_bgcolor',
					array(
						'default' => '#000',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);
				
				$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'jws_floating_c_h_bgcolor',
					$this->cutomizer_values('Icons hover background colour.', 'jws_floating_c_design', 'jws_floating_c_h_bgcolor', null)
				 
				));
					
					$wp_customize->add_setting(
					'jws_floating_c_size',
					array(
						'default' => '18',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);
					$wp_customize->add_control(
							    new WP_Customize_Range_Control(
							        $wp_customize,
							        'jws_floating_c_size',
							        array(
							            'label'       => __('Icons size.','jws_fl'),
							            'section'     => 'jws_floating_c_design',
							            'settings'    => 'jws_floating_c_size',
							            'input_attrs' => array(
							                'max' => 100,
							            ),
							        )
							    )
							);
			

				$wp_customize->add_setting(
					'jws_floating_c_b_color',
					array(
						'default' => '#000',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);
				
				$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'jws_floating_c_b_color',
					$this->cutomizer_values('Icons separator colour.', 'jws_floating_c_design', 'jws_floating_c_b_color', null)
			
				));


				$wp_customize->add_setting(
					'jws_floating_c_shadow',
					array(
						'default' => '1',
						'transport' => 'postMessage',
						'type' => 'option'
						
					)
				);
				$wp_customize->add_control(
					'jws_floating_c_shadow',
					$this->cutomizer_values('Enable shadow', 'jws_floating_c_design', 'jws_floating_c_shadow', 'checkbox')
			
				);


													/*adding custom class for customizer */
				$iconsleft = apply_filters ( 'jws_floating_left_icons', 

								array('dashicons dashicons-arrow-left-alt','dashicons dashicons-arrow-left-alt2','angle-left','arrow-circle-left','arrow-circle-o-left','arrow-left','caret-left','caret-square-o-left',
									'chevron-circle-left','chevron-left','hand-o-left','long-arrow-left')
								);									

				$wp_customize->add_setting( 'floating_left', array('transport' => 'postMessage','type' => 'option') );

				$wp_customize->add_control(new Jws_Floating_Custom_Customizer( $wp_customize, 'floating_left', array(
					 'section' => 'jws_floating_c_icons',
					 'priority' => 180,
					 'label' => __( 'Select left icon.', 'jws_fl' ),
					 'type' => 'radio',
					 'choices' => $iconsleft,

				) ) );



												
			
				$wp_customize->add_setting( 'floating_right', array('transport' => 'postMessage','type' => 'option') );
				$iconsright = apply_filters('jws_floating_right_icons',

								array('dashicons dashicons-arrow-right-alt','dashicons dashicons-arrow-right-alt2','angle-right','arrow-circle-right','arrow-circle-o-right','arrow-right','caret-right','caret-square-o-right','chevron-circle-right','chevron-right','hand-o-right','long-arrow-right')
								);
				$wp_customize->add_control(new Jws_Floating_Custom_Customizer( $wp_customize, 'floating_right', array(
					 'section' => 'jws_floating_c_icons',
					 'priority' => 180,
					 'label' => __( 'Select right icon.', 'jws_fl' ),
					 'type' => 'radio',
					 'choices' => $iconsright,

				) ) );
				

				$wp_customize->add_setting( 'floating_random', array('transport' => 'postMessage','type' => 'option') );
				$iconsright = apply_filters('jws_floating_random_icons',

								array('dashicons dashicons-randomize', 'random')
								);
				$wp_customize->add_control(new Jws_Floating_Custom_Customizer( $wp_customize, 'floating_random', array(
					 'section' => 'jws_floating_c_icons',
					 'priority' => 180,
					 'label' => __( 'Select Random icon.', 'jws_fl' ),
					 'type' => 'radio',
					 'choices' => $iconsright,

				) ) );
			
			
				$wp_customize->add_setting( 'floating_up', array('transport' => 'postMessage','type' => 'option') );
				$iconsup = apply_filters ('jws_floating_up_icons',

							array('dashicons dashicons-arrow-up-alt','dashicons dashicons-arrow-up-alt2','angle-up','arrow-circle-up',
								'arrow-circle-o-up','arrow-up','caret-up','caret-square-o-up','chevron-circle-up',
								'chevron-up','hand-o-up','long-arrow-up')
							);
				$wp_customize->add_control(new Jws_Floating_Custom_Customizer( $wp_customize, 'floating_up', array(
					 'section' => 'jws_floating_c_icons',
					 'priority' => 180,
					 'label' => __( 'Select up icon.', 'jws_fl' ),
					 'type' => 'radio',
					 'choices' => $iconsup,

				) ) );	

				$wp_customize->add_setting( 'floating_down', array('transport' => 'postMessage','type' => 'option') );
				 $iconsup = apply_filters ('jws_floating_down_icons',

				 			array('dashicons dashicons-arrow-down-alt','dashicons dashicons-arrow-down-alt2','angle-down','arrow-circle-down',
				 				'arrow-circle-o-down','arrow-down','caret-down','caret-square-o-down','chevron-circle-down','chevron-down','hand-o-down','long-arrow-down')
				 			);
				$wp_customize->add_control(new Jws_Floating_Custom_Customizer( $wp_customize, 'floating_down', array(
					 'section' => 'jws_floating_c_icons',
					 'priority' => 180,
					 'label' => __( 'Select down icon.', 'jws_fl' ),
					 'type' => 'radio',
					 'choices' => $iconsup,

				) ) );	


	}

	public function cutomizer_values($label, $section,  $settings, $type){
		
		
			$array = array (
								'label' => __($label, 'jws_fl' ),
								'section' => $section,
								'settings'   => $settings,
								'type' => $type,
					);
					return $array;
			
	}
			/**
		 * Used by hook: 'customize_preview_init'
		 * 
		 * @see add_action('customize_preview_init',$func)
		 */
	public	function jws_floating_live_preview()
		{
			wp_enqueue_script( 'floating_customizer_live', JWS_FLOATING_URL . 'js/floating_customizer_live.js',array( 'jquery','customize-preview' ), true );
		}

	public function jws_floating_customizer_css(){
		?>

						<style type="text/css">
							.floating_next_prev_wrap .floating_links a, .floating_next_prev_wrap .floating_links .disabled 
								{
								 
								background-color: <?php echo get_option('jws_floating_c_bg_color') ?> ; 
								color: <?php echo get_option('jws_floating_c_color') ?>;
								font-size: <?php echo get_option('jws_floating_c_size') ?>px;
					    	    border-color: <?php echo get_option('jws_floating_c_b_color') ?>;
								}
							
						.floating_next_prev_wrap .floating_links .disabled
								{
								color: #ebebe4 !important;
								}
							.floating_next_prev_wrap .floating_links a:hover
								{
								 background-color: <?php echo get_option('jws_floating_c_h_bgcolor') ?> ;
								color: <?php echo get_option('jws_floating_c_h_color') ?>;
									    
								}
				
						<?php 
							
							if( get_option('jws_floating_c_shadow') != '1') : 
								 ?>
								.floating_next_prev_wrap .floating_links
									{
									box-shadow:none;
									}
									
								<?php endif;
						
						?>			

						</style>
					<?php

			}	
					

}
$GLOBALS['customizer_holder'] = new JWS_FLOATING_CUSTOMIZER();