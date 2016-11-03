<?php
/**
 * Template Name: Full Width Page (with banner)
 *
 * Template for pages
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

get_header(); ?>

<?php

	$thumb 			= get_post_thumbnail_id($post->ID);
	$img_url 		= wp_get_attachment_url( $thumb,'full');
   
    ?>

	<div id="content-header" style="background-image: url(<?php echo($img_url); ?>);">
		<h2><?php echo(get_the_title()); ?></h2>
	</div>

	<div id="content-full" class="content-area">
		<main id="main" class="site-main full-width" role="main">

			<?php if ( have_posts() ) : ?>

				<?php get_template_part( 'template-parts/loop-header' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php echo(the_content()); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #content-full -->

<?php get_footer(); ?>
