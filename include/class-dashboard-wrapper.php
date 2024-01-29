<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('POCSCD_Dashboard_Wrapper')) :

    class POCSCD_Dashboard_Wrapper {
            
            public function __construct() {
                    
                    add_action('pocscd', array($this, 'page_content_hook'));
                    add_action('pocscd_display_lock_page', array($this, 'lock_screen'));
                    
            }
            
            public function define_params() {
                    
                    $params_args = array();

                    $param = new POCSCD_Custom_Query_Param(apply_filters('pocscd_add_page_param', $params_args));

                    return $param->get_param(); 
                                       
            }
            
            public function page_content_hook() {
                    
                    $params = $this->define_params();
                    
                    call_user_func(array($this, 'output'), $params);
                        
            }
            
            public function output($params) {
                    
                    if( empty($params) ) {
                            return;
                    }
                    
                    foreach ($params as $key => $value) {
                            do_action("pocscd_page_display_{$key}_{$value}", $params);
                    }
                    
            }
            
            public function lock_screen() {
                    
                    echo apply_filters('pocscd_lock_page_message', __('You are not allowed to access this page.', 'pocscd'));
                    
            }
            
    }
    
    new POCSCD_Dashboard_Wrapper();
    
endif;