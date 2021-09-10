<?php

/**
 * The Frontpage template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package starter-theme
 */
get_header();
?>

<main>
    <style type="text/css" scoped>
        .post-item-container {
            margin: 2rem 0;
        }

        @media screen and (min-width: 576px) {
            .post-item-container {
                columns: 2;
            }
        }

        .post-item {
            width: 100%;
            display: inline-flex;
            flex-direction: column;
            border-top-width: 1px;
            border-top-color: #d8d9da;
            border-top-style: solid;
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .post-item a {
            color: #000;
            font-weight: 500;
        }

        .container .content-container p {
            color: #475569;
            font-size: .875rem;
            padding: 0;
            margin: 0;
        }
    </style>
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