<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Big_Bob
 */

?>

<?php 
if (!is_home() && !is_front_page() && (is_page() || is_single() || is_singular())):
	?>
	<div id="bb-feature-image">
	<?php
	big_bob_post_thumbnail();
	?>
	</div>
	<?php
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
    if (get_theme_mod('big_bob_page_titles', 'On') == 'On') {
        if ((is_active_sidebar('sidebar-1') || has_nav_menu('menu-2')) &&
        ((get_theme_mod('big_bob_blog_sidebar_only', 'On') == 'Off')
            || ((get_theme_mod('big_bob_blog_sidebar_only', 'On') == 'Home Only') && !is_front_page())
            || ((get_theme_mod('big_bob_blog_sidebar_only', 'On') == 'Except Home') && is_front_page()))) :
        ?>
		<header class="entry-header bb-alignleftstyle">
		<?php
    else :
        ?>
		<header class="entry-header bb-aligncenterstyle">
		<?php
    endif; ?>
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	</header><!-- .entry-header -->
	<?php
    }
	if ( (is_active_sidebar( 'sidebar-1' ) || has_nav_menu('menu-2')) && 
		((get_theme_mod( 'big_bob_blog_sidebar_only', 'On' ) == 'Off') 
			|| ((get_theme_mod( 'big_bob_blog_sidebar_only', 'On' ) == 'Home Only') && !is_front_page()) 
			|| ((get_theme_mod( 'big_bob_blog_sidebar_only', 'On' ) == 'Except Home') && is_front_page()) ) ) :
		?>
		<main id="primary" class="entry-content bb-alignleftstyle">
		<?php
	else :
		?>
		<main id="primary" class="entry-content bb-aligncenterstyle">
		<?php
	endif;
	?>
		<?php 
		if (!(!is_home() && !is_front_page() && (is_page() || is_single() || is_singular()))):
		?>
		<div class="bb-center-image">
		<?php big_bob_post_thumbnail();
		?>
		</div>
		<?php
		endif;
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'big-scene' ),
				'after'  => '</div>',
			)
		);
		?>
		<div class="bb-negative"></div>
		<!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'big-scene' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
