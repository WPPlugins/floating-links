<?php

// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) exit;



								//======================================================================

													// Custom Class

								//======================================================================

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Jws_Floating_Custom_Customizer' ) ) :
				class Jws_Floating_Custom_Customizer extends WP_Customize_Control {
				 // Whitelist content parameter
				 public $content = '';
				 /**
				 * Render the control's content.
				 *
				 * Allows the content to be overriden without having to rewrite the wrapper.
				 *
				 * @since   1.0.0
				 * @return  void
				 */

				 public function render_content() { 
				 	
					if ( empty( $this->choices ) )
                    return;
 
                $name = '_customize-radio-' . $this->id;
 				
                if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo $this->description ; ?></span>
                <?php endif;
 
                foreach ( $this->choices as $value => $label ) :
                	
                    ?>
                
                    <label class="label">
                <div class="floating_icon_holder">    
				<input type="radio" value="<?php echo $label ?>" id="jws_floating_input" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $label ); ?> />
							<div class="jws_floating_bg_holder">
							<?php 
								if (strpos($label, 'dashicons') !== false) { ?>
										   <span class="<?php echo $label?>">
									<?php	} 
								else {	
								?>

							<span class="fa fa-<?php echo $label?>">
								<?php } ?>
                        	</span>
                        	</div>
					</div> 
                       
                    </label>
                    <?php
                endforeach;

					
				 }
				
			}
			endif;
//Input field
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WP_Customize_Range_Control' ) ) :
class WP_Customize_Range_Control extends WP_Customize_Control
{

    public $type = 'custom_range';
    public function enqueue()
    {

        wp_enqueue_script(
            'cs-range-control',
            JWS_FLOATING_URL . 'js/jws_fl_range_control.js',
            array('jquery'),
            false,
            true
        );
    }
    public function render_content()
    {
        ?>
        <label>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <div class="range_holder">
            <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            <div class="cs-range-value"><?php echo esc_attr($this->value()); ?></div>
            </div>
            <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
        </label>
        <?php
    }
}
endif;			