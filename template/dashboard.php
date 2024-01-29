<?php

if( pocscd_lock_page() ) {
	do_action('pocscd_display_lock_page');
	return;
} 

$query_vars = pocscd_app_query_vars();

$page_title = !empty($query_vars['app_page_title']) ? $query_vars['app_page_title'] : '';

global $wp_query;

$wp_query->set('post_type', 'page');
$wp_query->set('page_id', poscscd_dashboard_page_id());

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<?php 

do_action('pocscd'); 

?>

<?php wp_footer(); ?>

</body>
</html>