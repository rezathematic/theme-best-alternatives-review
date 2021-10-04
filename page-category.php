<?php

/**
 * The Category Page template file
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
            <div class="post-item-container">
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    echo '<div class="post-item">';
                    echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
?>