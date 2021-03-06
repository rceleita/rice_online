<?php
/**
 * Course Archive Template
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

<div id="content-archive" class="content-area">
	<div id="title">
		<h1>Course Catalog</h1>
	</div>
	<main id="main" class="site-main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="sorting-table">
			<?php get_template_part('framework/functions/course-filter'); ?>
		</div>
		<div class="courses">

			<?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'catalog' );
			?>

		</div>
	</main><!-- #main -->
	<?php get_sidebar(); ?>
</div><!-- #content-archive -->

<?php get_footer(); ?>
