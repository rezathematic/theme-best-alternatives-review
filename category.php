<?php
get_header();
?>

<main>
    <div class="container">
        <section class="content-container">
            <div class="post-item-container">
                <?php
                $current_category = get_queried_object(); // getting current category
                $args = array(
                    'post_type' => 'top-picks', // your post type,
                    'posts_per_page' => '-1',
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'cat' => $current_category->cat_ID // current category ID
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();

                        echo '<div class="post-item">';
                        echo '<a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>';
                        echo '<p>' . get_the_author() . '</p>';
                        echo '</div>';
                    }
                } else {
                    // no posts found
                    echo 'posts not found';
                }

                // Restore original Post Data
                wp_reset_postdata();
                ?>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
?>