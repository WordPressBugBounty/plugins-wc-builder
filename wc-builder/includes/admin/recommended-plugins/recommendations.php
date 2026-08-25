<?php
/**
 * Constructor Parameters
 *
 * @param string    $text_domain your plugin text domain.
 * @param string    $parent_menu_slug the menu slug name where the "Recommendations" submenu will appear.
 * @param string    $submenu_label To change the submenu name.
 * @param string    $submenu_page_name an unique page name for the submenu.
 * @param int       $priority Submenu priority adjust.
 * @param string    $hook_suffix use it to load this library assets only to the recommedded plugins page. Not into the whol admin area.
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( class_exists('Hasthemes\WpbForWpbakery\HTRP_Recommended_Plugins') ){
    $recommendations = new Hasthemes\WpbForWpbakery\HTRP_Recommended_Plugins(
        array(
            'text_domain'       => 'wpbforwpbakery',
            'parent_menu_slug'  => 'wpbforwpbakery_options',
            'menu_capability'   => 'manage_options',
            'menu_page_slug'    => '',
            'priority'          => '999',
            'assets_url'        => '',
            'hook_suffix'       => 'wc-page-builder_page_wpbforwpbakery_extensions'
        )
    );

    $recommendations->add_new_tab(array(
        'title' => __( 'Recommended Plugins', 'wpbforwpbakery' ),
        'active' => true,
        'plugins' => array(
            array(
                'slug'      => 'support-genix-lite',
                'location'  => 'support-genix-lite.php',
                'name'      => __( 'Support Genix - Helpdesk, AI Chatbot, Knowledge Base & Customer Support Ticketing System', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'hashbar-wp-notification-bar',
                'location'  => 'init.php',
                'name'      => __( 'Notification Bar for WordPress', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'wp-plugin-manager',
                'location'  => 'plugin-main.php',
                'name'      => __( 'WP Plugin Manager', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'ht-contactform',
                'location'  => 'contact-form-widget-elementor.php',
                'name'      => __( 'HT Contact Form – Drag & Drop Form Builder for WordPress', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'cookieray',
                'location'  => 'cookieray.php',
                'name'      => __( 'CookieRay - Cookie Banner for Cookie Consent (GDPR/CCPA Compliant)', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'kelune-crm',
                'location'  => 'kelune-crm.php',
                'name'      => __( 'Kelune CRM - Contact Management, Email Marketing, Newsletter & Marketing Automation', 'wpbforwpbakery' )
            ),
        )
    ));

    $recommendations->add_new_tab(array(
        'title' => esc_html__( 'WooCommerce', 'wpbforwpbakery' ),
        'plugins' => array(
            array(
                'slug'      => 'whols',
                'location'  => 'whols.php',
                'name'      => __( 'Whols - Wholesale Prices and B2B Store Solution for WooCommerce', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'swatchly',
                'location'  => 'swatchly.php',
                'name'      => __( 'Swatchly - Product Variation Swatches for WooCommerce', 'wpbforwpbakery' )
            ),
            array(
                    'slug'      => 'recurio',
                    'location'  => 'recurio.php',
                    'name'      => __( 'Recurio – Ultimate Subscription for WooCommerce', 'wpbforwpbakery' )
                ),
        )
    ));

    $recommendations->add_new_tab(array(
        'title' => esc_html__( 'Other Plugins', 'wpbforwpbakery' ),
        'plugins' => array(
            array(
                'slug'      => 'wp-plugin-manager',
                'location'  => 'plugin-main.php',
                'name'      => __( 'WP Plugin Manager', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'ht-easy-google-analytics',
                'location'  => 'ht-easy-google-analytics.php',
                'name'      => __( 'HT Easy GA4 ( Google Analytics 4 )', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'cookieray',
                'location'  => 'cookieray.php',
                'name'      => __( 'CookieRay - Cookie Banner for Cookie Consent (GDPR/CCPA Compliant)', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'insert-headers-and-footers-script',
                'location'  => 'init.php',
                'name'      => __( 'Insert Headers and Footers Code', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'pixelavo',
                'location'  => 'pixelavo.php',
                'name'      => __( 'Pixelavo - Server Side Tracking & Pixel + AI Ads Tools', 'wpbforwpbakery' )
            ),
            array(
                'slug'      => 'courseglade-lms',
                'location'  => 'courseglade-lms.php',
                'name'      => __( 'CourseGlade LMS - Online Course & eLearning Platform', 'wpbforwpbakery' )
            ),
        )
    ));
}
