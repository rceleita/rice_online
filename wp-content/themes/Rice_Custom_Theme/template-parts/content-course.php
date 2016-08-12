<?php
/**
 * Content Single Template
 *
 * The template used for displaying single posts
 *
 * @package      responsive_mobile
 * @license      license.txt
 * @copyright    2014 CyberChimps Inc
 * @since        0.0.1
 *
 * Please do not edit this file. This file is part of the responsive_mobile Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>

<?php responsive_mobile_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php responsive_mobile_entry_top(); ?>
	<?php get_template_part( 'template-parts/post-meta' ); ?>
	<?php
	// Added filter to get featured_image option working.
	$featured_image = apply_filters( 'responsive_mobile_featured_image', '1' );
	if ( has_post_thumbnail() && $featured_image ) {
		//the_post_thumbnail();
	} ?>

	<div class="post-entry">
		<?php the_content(); ?>
		
	</div><!-- .post-entry -->
	<?php get_template_part( 'template-parts/post-data' ); ?>
	<?php responsive_mobile_entry_bottom(); ?>
</article><!-- #post-## -->
<?php responsive_mobile_entry_after(); ?>