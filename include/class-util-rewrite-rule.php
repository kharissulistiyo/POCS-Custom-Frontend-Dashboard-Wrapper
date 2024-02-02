<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('POCSCD_Custom_Rewrite_Rules')) {
        
    class POCSCD_Custom_Rewrite_Rules {
            
        public  $rules;
        
        public function __construct() {
            add_action('wp_loaded', array($this, 'add_custom_rewrite_rule'));
            add_filter('query_vars', array($this, 'add_custom_query_var'));
        }
        
        public function get_rules() {

            $this->rules = apply_filters('pocscd_create_rewrite_rules', array(
                '__value_to_override' => array(
                    'regex' => '^admin/screen/([^/]+)/?$',
                    'query' => 'index.php?pagename=admin&screen=$matches[1]',
                ),
            )); 
            return $this->rules;

        }

        public function add_custom_rewrite_rule() {

            foreach ($this->get_rules() as $key => $value) {
                    
                    add_rewrite_tag(
                            "%{$key}%",
                            "([^/]+)",
                            "{$key}="
                    );
                    
                    add_rewrite_rule(
                        $value['regex'],
                        $value['query'],
                        'top'
                    );
                    
            }

            $this->flush_rewrite_rules();
        }

        public function add_custom_query_var($query_vars) {
                
                foreach ($this->rules as $key => $value) {
                        $query_vars[] = $key;
                }
                
            return $query_vars;
            
        }

        private function flush_rewrite_rules() {
            flush_rewrite_rules();
        }
    }

    // Instantiate the class
    $pocscd_custom_rewrite_rules = new POCSCD_Custom_Rewrite_Rules();
}