<?php
   
    if ( post_type_exists( 'course' ) ) {
        $count_posts = wp_count_posts( 'courses' );
        $num_posts = $count_posts->publish;
    } else {
        $num_posts = 0;
    }

    $types = get_terms('category_courses');
?>
<div class="course-filter course-filter-archive">
    <div>
        <h3 class="course-filter-heading accordion">Subject</h3>
        <nav class="taxonomy-nav">
            <ul class="taxonomy-menu">
                <?php $all_cat = site_url() . '/courses/'; ?>
                <li><a href="<?php echo($all_cat); ?>">All</a></li>
            <?php foreach ( $types as $type ) : ?>
                <?php $type_link = site_url() . '/category_courses/' . $type->slug . '/'; ?>
                <li>
                    <a href="<?php echo esc_url( $type_link ); ?>">
                    <?php echo( ucwords( $type->name ) ); ?>
                </a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <h3 class="course-filter-heading accordion">Platform</h3>
        <?php elr_tax_nav_filter($wp_query, 'course', 'course_platform'); ?>
        <h3 class="course-filter-heading accordion">Status</h3>
        <?php elr_tax_nav_filter($wp_query, 'course', 'course_status'); ?>
        <h3 class="course-filter-heading accordion">Archive</h3>
        <nav class="taxonomy-nav">
            <ul class="taxonomy-menu">
                <?php $archive_courses = site_url() . '/course_status/past-course/'; ?>
                <li><a href="<?php echo($archive_courses); ?>">All</a></li>
            </ul>
        </nav>
    </div>
</div>