<?php
    $tax_term = elr_get_current_tax($wp_query);

    if (post_type_exists('course')) {
        $count_posts = wp_count_posts('course');
        $num_posts = $count_posts->publish;
    } else {
        $num_posts = 0;
    }

    $types = get_terms('type');
?>
<div class="course-filter course-filter-single">
<!--     <div class="elr-hide-desktop course-filter-dropdowns">
        <div class="select-wrapper"><?php elr_tax_dropdown('courses', 'type', $tax_term); ?></div>
    </div> -->
    <!-- <div class="elr-hide-tablet elr-hide-mobile"> -->
        <h3 class="course-filter-heading">Select Jewelry</h3>
        <nav class="taxonomy-nav">
            <ul class="taxonomy-menu">
            <?php foreach ($types as $type) : ?>
                <?php $type_link = '/' . $type->slug . '/'; ?>
                <li>
                    <a href="<?php echo esc_url($type_link); ?>">
                    <?php echo(ucwords($type->name)); ?>
                </a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <h3 class="course-filter-heading">Available Metals</h3>
        <?php elr_course_options('course', 'metal', $post->ID); ?>
        <h3 class="course-filter-heading">Available Colors</h3>
        <?php elr_course_options('course', 'color', $post->ID); ?>
    <!-- </div> -->
</div>