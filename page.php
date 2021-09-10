<?php

/**
 * The Page template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package starter-theme
 */
get_header();
?>

<main>
    <div class="container">
        <section class="content-container">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();

                    the_content();

                endwhile;
            endif;
            ?>
        </section>
    </div>
</main>

<?php
get_footer();
?>