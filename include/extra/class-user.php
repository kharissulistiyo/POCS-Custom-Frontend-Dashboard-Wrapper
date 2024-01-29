<?php 
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('POCSCD_User')) {
    class POCSCD_User {
        
        private $user_id = 0;
        
        /**
         * Constructor.
         */
        public function __construct() {
                
            $this->user_id = 0;
                
            add_action('admin_init', array($this, 'init_roles'));
            
        }
        /**
         * Initialize the default roles.
         */
        public function init_roles() {   
            
            $app_reader_role = apply_filters('pocscd_create_user_role_reader', array());
            
            $reader_cap = !isset($app_reader_role['cap']) ? get_role( 'subscriber' )->capabilities : $app_reader_role['cap'];
            
            add_role(
                isset($app_reader_role['slug']) ? $app_reader_role['slug'] : '',
                isset($app_reader_role['name']) ? $app_reader_role['name'] : '',
                $reader_cap
            );
            
            // Author role
            
            $app_author_role = apply_filters('pocscd_create_user_role_author', array());
            
            $author_cap = !isset($app_author_role['cap']) ? get_role( 'author' )->capabilities : $app_author_role['cap'];
            
            
            add_role(
                isset($app_author_role['slug']) ? $app_author_role['slug'] : '',
                isset($app_author_role['name']) ? $app_author_role['name'] : '',
                $author_cap
            );
            
            // Administrator role
            
            $app_administrator_role = apply_filters('pocscd_create_user_role_administrator', array());
            
            $administrator_cap = !isset($app_administrator_role['cap']) ? get_role( 'administrator' )->capabilities : $app_administrator_role['cap'];
            
            add_role(
                isset($app_administrator_role['slug']) ? $app_administrator_role['slug'] : '',
                isset($app_administrator_role['name']) ? $app_administrator_role['name'] : '',
                $administrator_cap
            );
            
        }
        
        public function no_admin_access() {
                
                if( !is_user_logged_in() ) {
                        return;
                }
                
                if ( is_admin()) :
                
                
                $roles = array('author');                
                
                $user_id = get_current_user_id();
                $wp_user = wp_get_current_user();
                
                $get_role = '';
                
                if( $wp_user ) {
                        $role = (array) $wp_user->roles;
                        $get_role = $role[0];
                }
                
                if( in_array($get_role, $roles) && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {
                        
                        $home_url = add_query_arg('screen', 'home', get_permalink(bm_dashboard_page_id()));
                        
                        switch ($get_role) {
                                case 'subscriber':
                                        wp_redirect($home_url, 301);
                                        break;
                                case 'author':
                                case 'xyz_author':
                                case 'xyz_reader':
                                        wp_redirect($home_url, 301);
                                        break;
                                default:
                                        // code...
                                        break;
                        }
                
                }
                
                endif;
        
        }
        
        function disable_admin_bar($show) {
                
                // Define an array of roles to check
                $roles_to_disable_admin_bar = array('author');  
                
                // Check if the current user has one of the specified roles
                $user = new WP_User(get_current_user_id());
                if (array_intersect($roles_to_disable_admin_bar, $user->roles)) {
                    return false; // Disable the admin bar for users with specified roles
                }

                return $show; // Keep the admin bar visible for other users
                
        }
        
    }

    // Instantiate the class
    $bm_user = new POCSCD_User();
}