<?php 

/**
 * Plugin Name: Custom Frontend Dashboard Wrapper
 * Plugin URI: https://pocspartner.com
 * Description: Custom Frontend Dashboard Wrapper is a plugin that allows developer to easily create custom frontend dashboard. It would be a starter point for making custom web based application built on top of WordPress CMS.
 * Version: 1.0.0
 * Author: Kharis Sulistiyono
 * Author URI: https://kharis.risbl.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pocscd
 * Domain Path: /languages
 */

 // Load the text domain for translations
 load_plugin_textdomain('pocscd', false, dirname(plugin_basename(__FILE__)) . '/languages');

 define( 'POCSCD_DIRNAME', 'pocscd' );
 define( 'POCSCD_DIRECTORY', dirname(__FILE__) );
 define( 'POCSCD_PLUGIN_URL', plugin_dir_path(__FILE__));

$files = array(
    'include' => 'include.php', // Maybe we would add more files after this line.
); 

foreach ($files as $key => $file) {
$path_file = POCSCD_PLUGIN_URL . 'include/' . $file;
    if (file_exists($path_file)) {
    require_once $path_file;
}
}