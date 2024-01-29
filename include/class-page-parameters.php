<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('POCSCD_Custom_Query_Param')) {

    class POCSCD_Custom_Query_Param {

            private $param;
            private $keys;

            public function __construct($keys=array()) {
                    
                $this->param = array();
                $this->keys = $keys;
                $this->initialize_param();
                
            }
            
            private function get($key, $default) {
                
                return ( !isset($_GET[$key]) ) ? get_query_var($key, '') : $_GET[$key];
                
            }
            
            public function initialize_param() {
                
                foreach ($this->keys as $val) {
                        if( !isset($_GET[$val]) ) {
                                $this->param[$val] = get_query_var($val, ''); 
                        }
                        if( isset($_GET[$val]) ) {
                                $this->param[$val] = $this->get($val, '');  
                        }
                }
                  
            }
            
            public function get_param() {
                    
                return apply_filters('pocscd_page_parameters', $this->param);
                
            }
        
    }
    
}