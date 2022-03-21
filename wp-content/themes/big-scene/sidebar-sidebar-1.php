<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Big_Bob
 */

if ( !is_active_sidebar( 'sidebar-1' ) && !has_nav_menu('menu-2')) {
	return;
}
?>

<aside id="secondary" class="sideStick widget-area bb-alignrightstyle">
	<?php 
	wp_nav_menu( 
	array(
		'theme_location' => 'menu-2',
		'menu_id'        => 'bb-sidebar-menu',
		'menu_class' => 'bb-side-menu',
		'fallback_cb' => false
		) 
	);
	dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
