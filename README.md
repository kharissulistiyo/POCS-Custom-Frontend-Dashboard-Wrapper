# About the project

## What is the project name?

Custom Frontend Dashboard Wrapper (for WordPress)

## What is the purpose of Custom Frontend Dashboard Wrapper? 

Custom Frontend Dashboard Wrapper is a plugin that allows developer to easily create custom frontend dashboard. 

It would be a starter point for making custom web based application built on top of WordPress CMS.

## Is there any demo to check?

![Demo preview](https://i.snipboard.io/PQziTr.jpg)

Yes, we have the demo! Check it by doing these steps:

1. Open https://wpsandbox.pocsdgtl.xyz/cfd-app/wp-login.php
2. Login using these credentials:

```
username: usercustomer
password: usercustomer
```

3. Visit the frontend dashboard from [this link](https://wpsandbox.pocsdgtl.xyz/cfd-app/admin/screen/home) (as we don't have auto redirect yet for now)

Please note that the demo has been made with custom code in separate plugin.

## How to use Custom Frontend Dashboard Wrapper?

1. Download the zip package of the plugin
2. Install to your WordPress site and activate

You'll see nothing happen with your site once the plugin is installed until you add custom functions with several hooks provided by the plugin. You would need to write your own plugin file(s) to host your custom functions. 

### Let's start making a starting point for your frontend custom dashboard. 

1. Create a custom dashboard page via `[pocs-custom-dashboard]` shortcode. [Screenshot](https://i.snipboard.io/4aAVd7.jpg)
2. Define template file for custom dashboard page. 

```
add_filter('pocscd_dashboard_page_template_file', 'my_app_dashboard_template_file, 10, 2);
function my_app_dashboard_template_file($template, $dashboard_page_id) {

    return 'path/to/your/app-dashboard-template-file.php';

}
```

Your template file must include these code:

```
global $wp_query;

$wp_query->set('post_type', 'page');
$wp_query->set('page_id', pocscd_dashboard_page_id());

if( pocscd_lock_page() ) {
	do_action('pocscd_display_lock_page');
	return;
} 
```

The code above retains page ID (where the shortcode presents) and enable page locking functionality.

```
do_action('pocscd'); 
```

This is mandatory action hook that is used in `POCSCD_Dashboard_Wrapper` class. You may use this hook as well to add page content via separate file.

See `template/dashboard.php`.


3. Add custom page URL parameters

```
add_filter('pocscd_add_page_param', 'my_app_dashboard_param, 5, 1);
function my_app_dashboard_param($param) {

    $param[] = 'screen';
    $param[] = 'todo';
    return $param;

}
```

4. Enable pretty permalink with rewrite rules

```
add_filter('pocscd_create_rewrite_rules', 'my_app_dashboard_permalink_rules');
function my_app_dashboard_permalink_rules() {

    $rules = array();
    
    $rules['screen'] = array(
            'regex' => '^admin/screen/([^/]+)/?$',
            'query' => 'index.php?pagename=admin&screen=$matches[1]',                            
    );
    
    return $rules;

}
```

5. Create a page for `screen` parameter

To create a page for `/front-end-dashboard/screen/home`, add this snippet:

```
add_action('pocscd_page_display_screen_home', 'my_app_dashboard_page_screen_home', 5, 1);
function my_app_dashboard_page_screen_home($param) {

    // Display something here.

}
```

If you wish to add another page, use this action hook `pocscd_page_display_screen_{{param_val}}`. Replace `{{param_val}}` with expected value for screen parameter.

6. Restrict page access

Simply use this snippet allow page access only for particular user:

```
add_filter('pocscd_lock_page', 'my_app_dashboard_lock_page_conditions');
function my_app_dashboard_lock_page_conditions() {

    if( is_user_logged_in() ) {
        return false; // Unlock page. Allow access if user is logged in. 
    }
    
    return true; // Lock page. No public access. 

}
```

## Extra

See **extra** folder which includes:

* Custom Post Type creation handler
* User handler