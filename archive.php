<?php
get_header();
?>

<main>
    <div class="container">
        <section class="content-container">
            <div class="post-item-container">

                <?php
                // WP_Query arguments
                $args = array(
                    'post_type'              => array('top-picks'),
                    'post_status'            => array('publish'),
                    'posts_per_page'         => '-1',
                    'order'                  => 'DESC',
                );

                // The Query
                $query = new WP_Query($args);

                // The Loop
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();

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