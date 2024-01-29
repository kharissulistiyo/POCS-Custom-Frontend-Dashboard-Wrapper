<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class POCSCD_Custom_Dashboard_Shortcode {

    public function __construct() {
                // Register the shortcode
                add_shortcode( 'pocs-custom-dashboard', array( $this, 'render_custom_dashboard' ) );
                add_action('template_include', array($this, 'custom_page') );
    }

    // Shortcode callback function
    public function render_custom_dashboard( $atts ) {
                // Shortcode attributes
                $atts = shortcode_atts(
                    array(
                        'param1' => '',
                        'param2' => '',
                    ),
                    $atts,
                    'pocs-custom-dashboard'
                );

                $output = ''; // Display nothing

                return $output;
    }
    
    public function custom_page($template) {
            
                $dashboard_page_id = poscscd_dashboard_page_id();
                
                $dir = '/template'; // We may change the folder path later.
                
                if( is_page($dashboard_page_id) ) {
                        require_once( apply_filters('pocscd_dashboard_page_template_file', POCSCD_DIRECTORY . $dir . '/dashboard.php', $dashboard_page_id) );
                        exit;
                }
                
                return $template;    
                
    }
    
}

// Instantiate the class
new POCSCD_Custom_Dashboard_Shortcode();
