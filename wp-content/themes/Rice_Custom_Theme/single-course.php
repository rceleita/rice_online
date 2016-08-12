<?php
/**
 * Single Post Template
 *
 * Displays single posts
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
	$enroll 		= get_post_meta(get_the_ID(), 'Enroll Now', true);
	$start 			= get_post_meta(get_the_ID(), 'Course Start', true);
	$length 		= get_post_meta(get_the_ID(), 'Course Length', true);
	$time 			= get_post_meta(get_the_ID(), 'Time Requirement', true);
	$profname 		= get_post_meta(get_the_ID(), 'Professor Name', true);
	$profbio		= get_post_meta(get_the_ID(), 'Professor Bio', true);
	$profpic		= get_post_meta(get_the_ID(), 'Professor Pic', true);
	$certificate	= get_post_meta(get_the_ID(), 'Certificate', true);
	$tuition		= get_post_meta(get_the_ID(), 'Tuition', true);

?>

	<div id="content-header" style="background-image: url(<?php echo($img_url); ?>);">
		<h2><?php echo(get_the_title()); ?></h2>
		<p><a href="<?php echo($enroll); ?>" class="button enroll">Enroll Now</a></p>
	</div>
	<div id="course-info">
		<ul>
			<li><span>Duration</span><?php echo($length); ?></li>
			<li><span>Professor</span><?php echo($profname); ?></li>
			<li><span>Workload</span><?php echo($time); ?> Hours</li>
			<li><span>Certificate Offered</span><?php echo($certificate) ?></li>
			<li><span>Tuition</span><?php echo($tuition); ?></li>
		</ul>
	</div>

	<div id="content" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php get_template_part( 'template-parts/loop-header' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'course' ); ?>

					<?php responsive_mobile_comments_before(); ?>
					<?php responsive_mobile_comments_after(); ?>

				<?php endwhile; // end of the loop. ?>
				
				<div id="professor">
					<div class="headshot">
						<img src="<?php echo($profpic); ?>" alt="Picture of <?php echo($profname); ?>" />
					</div>
					<div class="professorinfo">
						<h4><?php echo($profname); ?></h4>
						<p><?php echo($profbio); ?></p>
					</div>
				</div>

			</main><!-- #main -->

			<?php get_sidebar(); ?>
	</div><!-- #content -->
<?php get_footer(); ?>