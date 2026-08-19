<?php

// don't load directly
if (!defined('ABSPATH')) die('-1');

class WPBForWPbakery_Product_Title{
    function __construct() {

        // creating shortcode addon
        add_shortcode( 'wpbforwpbakery_product_title', array( $this, 'render_shortcode' ) );

        // We safely integrate with VC with this hook
        add_action( 'vc_after_init', array( $this, 'integrateWithVC' ) );
    }

    public function render_shortcode( $atts, $content = null ) {

        extract(shortcode_atts(array(
            'tag' => 'h1', 
            'text_align' => '', 
            'text_color' => '', 
            'font_size' => '', 
            'line_height' => '', 
            'use_google_font' => '', 
            'google_font' => 'font_family:Abril Fatface|font_style:400 regular', 
            'el_class' => '', 
            'wrapper_css' => '', 
        ),$atts));

        $style = '';
        $styles = array();

        // Sanitize CSS values to prevent XSS
        $text_align = wpbforwpbakery_sanitize_css_value( $text_align );
        $text_color = wpbforwpbakery_sanitize_css_value( $text_color );
        $font_size = wpbforwpbakery_sanitize_css_value( $font_size );
        $line_height = wpbforwpbakery_sanitize_css_value( $line_height );

        if( $text_align != "" ){
        	$styles[] = 'text-align:'. $text_align .'';
        }

        if( $text_color != "" ){
        	$styles[] = 'color:'. $text_color .'';
        }

        if( $font_size != "" ){
        	$styles[] = 'font-size:'. $font_size .'';
        }

        if( $line_height != "" ){
        	$styles[] = 'line-height:'. $line_height .'';
        }

        $font_inline_style = '';
        if($use_google_font == 'true'){
        	$font_data = wpbforwpbakery_get_fonts_data( $google_font );
        	wpbforwpbakery_enqueue_google_font( $font_data );
        	$font_inline_style = wpbforwpbakery_get_font_inline_style( $font_data );
        }

        // concate styles
        if ( ! empty( $styles ) ) {
        	$style = 'style="' . esc_attr( implode( ';', $styles ) . ';' . $font_inline_style ) . '"';
        }
        
        $allowed_tags = array_keys( wpbforwpbakery_html_tag_lists() );
        $tag = in_array( $tag, $allowed_tags ) ? $tag : 'h1';

        ob_start();

        echo '<div class="wpbforwpbakery_product_title '. esc_attr($el_class) .wpbforwpbakery_get_vc_custom_class($wrapper_css, ' ') .'">';
        printf('<%1$s class="" %2$s>%3$s</%1$s>',
        	$tag,
        	$style,
        	get_the_title()
        );
        echo '</div>';

        return ob_get_clean();
  }

  
  public function integrateWithVC() {
  
      /*
      Lets call vc_map function to "register" our custom shortcode within WPBakery Page Builder interface.

      More info: http://kb.wpbakery.com/index.php?title=Vc_map
      */
      vc_map( array(
          "name" => __("WCB: Product title", 'wpbforwpbakery'),
          "base" => "wpbforwpbakery_product_title",
          "class" => "",
          "icon" => 'dashicons dashicons-editor-textcolor',
          "category" => __('WC Builder', 'wpbforwpbakery'),
          "params" => array(
              array(
                  "param_name" => "tag",
                  "heading" => __("Title HTML Tag", 'wpbforwpbakery'),
                  "type" => "dropdown",
                  "std" => 'h1',
                  'value' => wpbforwpbakery_html_tag_lists(),
              ),
              array(
                "param_name" => "text_align",
                "heading" => __("Text Align", 'wpbforwpbakery'),
                "type" => "dropdown",
                "std" => 'left',
                'value' => wpbforwpbakery_text_align_lists(),
              ),
              array(
                  'param_name' => 'text_color',
                  'heading' => __( 'Text color', 'wpbforwpbakery' ),
                  'type' => 'colorpicker',
              ),
              array(
                  'param_name' => 'font_size',
                  'heading' => __( 'Font Size', 'wpbforwpbakery' ),
                  'type' => 'textfield',
                  'description' => __( 'Ex: 23px', 'wpbforwpbakery' ),
              ),
              array(
                  'param_name' => 'line_height',
                  'heading' => __( 'Line Height', 'wpbforwpbakery' ),
                  'type' => 'textfield',
                  'description' => __( 'Ex: 25px', 'wpbforwpbakery' ),
              ),
              array(
                'type' => 'checkbox',
                'heading' => __( 'Use google font?', 'wpbforwpbakery' ),
                'param_name' => 'use_google_font',
                'description' => __( 'Use font family from google font.', 'wpbforwpbakery' ),
              ),
              array(
                'type' => 'google_fonts',
                'param_name' => 'google_font',
                'settings' => array(
                  'fields' => array(
                    'font_family_description' => __( 'Select font family.', 'wpbforwpbakery' ),
                    'font_style_description' => __( 'Select font styling.', 'wpbforwpbakery' ),
                  ),
                ),
                'dependency' =>[
                    'element' => 'use_google_font',
                    'value' => array( 'true' ),
                ],
              ),

              array(
                  'param_name' => 'el_class',
                  'heading' => __( 'Extra class name', 'wpbforwpbakery' ),
                  'type' => 'textfield',
                  'description' => __( 'Style this element differently - add a class name and refer to it in custom CSS.', 'wpbforwpbakery' ),
              ),
              array(
                "param_name" => "wrapper_css",
                "heading" => __( "Wrapper Styling", "wpbforwpbakery" ),
                "type" => "css_editor",
                'group'  => __( 'Wrapper Styling', 'wpbforwpbakery' ),
            ),
          )
      ) );
  }

}

// Finally initialize code
new WPBForWPbakery_Product_Title();