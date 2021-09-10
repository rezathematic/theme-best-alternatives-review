<?php

/**
 * The main template file
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
        <article>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis repellendus asperiores nesciunt beatae deleniti perspiciatis perferendis recusandae ut voluptatibus fugit, impedit velit soluta quia maxime facilis voluptates, neque explicabo rerum.
        </article>
    </div>
</main>

<?php
get_footer();
?>