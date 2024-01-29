<?php 
if (!defined('ABSPATH')) {
        exit;
}

if ( ! function_exists( 'poscscd_dashboard_page_id' ) ) :

        function pocscd_app_query_vars() {
                
                $params_args = array();

                $param = new POCSCD_Custom_Query_Param(apply_filters('pocscd_add_page_param', $params_args));
                $app_query_var = $param->get_param();
                
                $params = array();
                
                $param = $params;
                
                $param['app_query_var'] = $app_query_var;
                
                $default_string = '';
                $param['app_page_title'] = apply_filters('pocscd_app_page_title', $default_string, $app_query_var);
                
                return $param;
                
        }

endif;

if ( ! function_exists( 'poscscd_dashboard_page_id' ) ) :
        
        function poscscd_dashboard_page_id(){
                
                // Define the shortcode to search for
                $the_shortcode = 'pocs-custom-dashboard';

                // Get all pages
                $pages = get_pages();
                
                $page_id = 0;
                
                // Loop through each page
                foreach ($pages as $page) {
                    // Get the content of the page
                    $page_content = $page->post_content;

                    // Check if the shortcode exists in the content
                    if (has_shortcode($page_content, $the_shortcode)) {
                        // The shortcode is found on this page
                        $page_id = $page->ID;
                        break; // Stop searching after finding the first occurrence
                    }
                }
                
                return $page_id;

                // If the shortcode is not found on any page
                if (empty($page_id)) {
                    return $page_id;
                }
                
        }

endif;

if ( ! function_exists( 'poscscd_build_link' ) ) :
        
        function poscscd_build_link($post_id, $args) {
                
                  $defaults = array(
                         'param_key' => '',
                         'param_val' => '', 
                  );
                
                  $args = wp_parse_args( $args, $defaults );
                  
                  return get_permalink($post_id) . "{$args['param_key']}/{$args['param_val']}";
                
        }
        
endif;

if ( ! function_exists( 'pocscd_lock_page' ) ) :
        function pocscd_lock_page() {
                
                return apply_filters('pocscd_lock_page', true);
                
        }
endif;

if ( ! function_exists( 'pocscd_check_user_role' ) ) :
        function pocscd_check_user_role($user_id, $role_slug) {

                if(!$user_id) {
                        return false;
                }
                
                $user = get_userdata($user_id);
                
                if ($user && in_array($role_slug, (array)$user->roles)) {
                    return true;
                }

                return false;        
        }
endif;

if ( ! function_exists( 'poscd_check_user' ) ) :
        function poscd_check_user($user_id, $role_slug) {

                if(!$user_id) {
                        return false;
                }
                
                $user = get_userdata($user_id);
                
                if ($user && in_array($role_slug, (array)$user->roles)) {
                return true;
                }

                return false;        
        }
endif;

if ( ! function_exists( 'pocscd_user_is_administrator' ) ) :
        function pocscd_user_is_administrator($user_id) {
                
                $roles = array('administrator');
                
                $true = false;
                
                foreach ($roles as $role) {
                        $is_user = poscd_check_user($user_id, $role);
                        
                        if($is_user) {
                                $true = true;        
                        }
                        
                }
                
                return $true;
                
        }
endif;