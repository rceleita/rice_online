<?php

////////////////////////////////////////////
// INCLUDES
////////////////////////////////////////////

include 'framework/functions/frontend-scripts.php';
include 'framework/functions/custom-post.php';
include 'framework/functions/list-categories.php';
include 'framework/functions/blog-functions.php';
include 'framework/functions/featured-post.php';
include 'framework/functions/tax-functions.php';


/* ================================================== */


// SLUGIFY

function elr_slugify($str) {
    return str_replace(' ', '-', strtolower($str));
}

/* ================================================== */

// Get Related Terms

function elr_get_related_terms($taxonomy, $type) {
    $rel_terms = array();
    $query = new WP_Query(
        array(
            'post_type' => $type,
            'posts_per_page' => -1
           )
  	);

    $items = $query->get_posts();

    foreach($items as $item) {
        $term = wp_get_post_terms($item->ID, $taxonomy);
        array_push($rel_terms, $term[0]->name);
    }

    return array_unique($rel_terms);
}

/* ================================================== */

// GET TERM NAMES

function elr_get_term_names($terms) {
    $term_names = [];

    // create an array of term names
    foreach ($terms as $term) {
        array_push($term_names, $term->name);
    }

    return $term_names;
}

/* ================================================== */

// COURSE OPTIONS

function elr_product_options($post_type, $taxonomy, $post_id) {

    $tax_args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => true
   );

    $tax_name = ucwords(str_replace('_' , ' ', $taxonomy));
    $terms = get_terms(array($taxonomy), $tax_args);
    $style = wp_get_post_terms($post_id, 'course');
    $style = $style[0];
    $active_class = ($taxonomy == 'category_courses');
    $rel_terms = elr_get_related_terms($taxonomy, 'course', $style, 'style');

    // if term is in style group add class active

    if ($terms) {
        echo '<nav class="taxonomy-nav">';
        echo '<ul class="taxonomy-menu taxonomy-' . $taxonomy . '">';

            // list all terms
            foreach ($terms as $term) {
                $term_link = get_term_link($term);
                // if term is in the rel_terms array add an active class
                if (in_array($term->name, $rel_terms, TRUE)) {
                    echo '<li class="';
                    echo elr_slugify($taxonomy) . '-' . elr_slugify($term->name);
                    echo '">';

                    if ($taxonomy == 'color') {
                        echo '<span class="' . $active_class . '">';
                        echo(ucwords($term->name));
                        echo '</span>';
                    } else {
                        echo '<span ';
                        echo 'class="' . $active_class . '"';
                        echo '>';
                        echo(ucwords($term->name));
                        echo '</span>';
                    }

                    echo '</li>';
                }
            }
        echo '</ul></nav>';
    }
}

// GET RELATED POSTS

function elr_get_related_posts($taxonomy = 'category', $post_type = 'current', $num_posts = 3) {
    $id = get_the_ID();

    // config
    if ($taxonomy === 'category') {
        $term_name = $taxonomy;
        $term_id = 'cat_ID';
    } else if ($taxonomy === 'tag') {
        $term_name = 'post_tag';
        $term_id = 'term_id';
    } else {
        $term_name = $taxonomy;
        $term_id = 'term_id';
    }

    if ($post_type == 'current') {
        $post_type = get_post_type();
    }

    $terms = get_the_terms($id, $term_name);
    $related = [];

    // TODO: need to check if term exists
    if (!empty($terms)) {
        foreach($terms as $term) {
            $related[] = $term->$term_id;
        }
    } else {
        return;
    }

    if ($taxonomy == 'category') {
        $posts = new WP_Query(
            array(
                'posts_per_page' => $num_posts,
                'category__in' => $related,
                'post__not_in' => array($id),
                'post_type' => $post_type,
                'orderby' => 'post_date',
           )
       );
    } else if ($taxonomy == 'tag') {
        $posts = new WP_Query(
            array(
                'posts_per_page' => $num_posts,
                'tag__in' => $related,
                'post__not_in' => array($id),
                'post_type' => $post_type,
                'orderby' => 'post_date',
           )
       );
    } else {
        $posts = new WP_Query(
            array(
                'posts_per_page' => $num_posts,
                'post_type' => $post_type,
                'post__not_in' => array($id),
                'orderby' => 'post_date',
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'terms'    => $related,
                        'field'    => 'term_id',
                   ),
               ),
           )
       );
    }

    return $posts;
}

function elr_related_posts_images($taxonomy = 'category', $post_type = 'current', $num_posts = 3) {
    $loop = elr_get_related_posts($taxonomy, $post_type, $num_posts);

    if ($loop->have_posts()) {
        $related_posts = '<ul class="related-category-posts elr-unstyled-list">';
        while($loop->have_posts()) {
            $loop->the_post();
            if (has_post_thumbnail()) {
                $related_posts .= '<li><a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a></li>';
            } else {
                $related_posts .= '<li><a href="' . get_permalink() . '"><img src="' . IMAGES . '/design-ring.jpg" alt="Ring"></a></li>';
            }
        }
        $related_posts .= '</ul>';
        wp_reset_query();

        return $related_posts;
    } else {
        return;
    }
}

/* ================================================== */

function elr_tax_dropdown_filter($post_type, $taxonomy, $current_term = null) {

    $tax_args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => true
   );

    $tax_name = ucwords(str_replace('_' , ' ', $taxonomy));
    $terms = get_terms(array($taxonomy), $tax_args);
    $term_names = elr_get_term_names($terms);
    $active_class = ($taxonomy == 'color') ? 'active color-swatch' : 'active';

    if ($terms) {
        echo '<select class="taxonomy-dropdown taxonomy-dropdown-filter" data-tax="' . $taxonomy . '">';
        echo '<option value="all" selected>Select ' . ucwords($taxonomy) . '</option>';
        echo '<option value="all">All</option>';

            // list all terms
            foreach ($terms as $term) {
                $term_link = get_term_link($term);
                echo '<option ';
                    echo 'value="';
                    echo $term->slug;
                    echo '">';
                    echo(ucwords($term->name));
                echo '</option>';
            }
        echo '</select>';
    }
}

function elr_tax_dropdown($post_type, $taxonomy, $current_term = null) {

    $tax_args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => true
    );

    $tax_name = ucwords(str_replace('_' , ' ', $taxonomy));
    $terms = get_terms(array($taxonomy), $tax_args);
    $term_names = elr_get_term_names($terms);

    if ($terms) {
        echo '<select class="taxonomy-dropdown">';
        echo '<option value="" selected>Select ' . ucwords($taxonomy) . '</option>';

            // list all terms
            foreach ($terms as $term) {
                $term_link = get_term_link($term);
                echo '<option ';
                    echo 'value="';
                    echo esc_url($term_link);
                    echo '">';
                    echo(ucwords($term->name));
                echo '</option>';
            }
        echo '</select>';
    }
}

function elr_tax_nav_filter($query, $post_type, $taxonomy, $current_term = null) {

    $tax_args = array(
        'orderby'           => 'name',
        'order'             => 'ASC',
        'hide_empty'        => true
   );

    $tax_name 	= ucwords(str_replace('_' , ' ', $taxonomy));
    $terms 		= get_terms(array($taxonomy), $tax_args);
    $term_names = elr_get_term_names($terms);
    $rel_terms 	= elr_get_related_terms($taxonomy, $post_type);
    $base_url	= site_url();

    if ($terms) {
        echo '<nav class="taxonomy-nav taxonomy-filter">';
        echo '<ul class="taxonomy-menu taxonomy-' . $taxonomy . '" data-tax="' . $taxonomy . '">';

            if ($current_term && in_array($term_names, $current_term)) {
                echo '<li class="filter-all"><a href="' . $base_url . '/courses/" data-term="all">All</a></li>';
            } else {
                echo '<li class="filter-all"><a href="' . $base_url . '/courses/" class="active" data-term="all">All</a></li>';
            }

            // list all terms
            foreach ($terms as $term) {
                if (in_array($term->name, $rel_terms, TRUE)) {
                    $term_link = get_term_link($term);

                    if ($term->name === $current_term && $taxonomy == 'course_platform') {
                        $class = 'active platform';
                    } else if ($term->name === $current_term) {
                        $class = 'active';
                    } else if ($taxonomy == 'course_platform') {
                        $class = 'inactive';
                    } else {
                        $class = 'inactive';
                    }

                    echo '<li class="';
                    echo elr_slugify($taxonomy) . '-' . elr_slugify($term->name);
                    echo '">';
                        echo '<a href="';
                        echo esc_url($term_link) . '"';
                            echo 'class="' . $class . '"';
                            echo 'data-term="' . $term->slug . '"';
                        echo '>';
                        echo(ucwords($term->name));
                        echo '</a>';
                    echo '</li>';
                }
            }
        echo '</ul></nav>';
    }
}

function get_products($tax, $term, $num = 5) {
    $args = [
        'post_type' => 'course',
        'posts_per_page' => $num,
        'tax_query' => [
            [
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $term
            ]
        ]
    ];

    $query = new WP_Query($args);

    return $query;
}

function get_product_terms($tax, $filter_term, $filter_term_tax) {
    $products = get_products($filter_term_tax, $filter_term, -1);
    $terms = [];

    if ($products->have_posts()) {
        while ($products->have_posts()) : $products->the_post();
            global $post;
            $term = get_the_terms($post->ID, $tax);
            $name = $term[0]->name;
            array_push($terms, $name);
        endwhile;
        wp_reset_postdata();

        return array_unique($terms);
    } else {
        return;
    }
}

function get_first_product($tax, $term) {
    return get_products($tax, $term, 1);
}

function get_term_children_num($tax, $term) {
    $products = get_products($tax, $term, -1);

    return $products->post_count;
}
?>