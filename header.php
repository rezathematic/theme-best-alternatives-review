<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TMJPWFV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="header-container">
        <header>
            <!-- Navbar -->
            <div class="header">
                <div class="logo" style="color: white; font-size: 1.2rem;">
                    <!-- <img src="https://toybin.org/wp-content/uploads/2021/08/Toybin-logo-125x125-1.png" alt=""> -->
                    <a href="<?php echo home_url(); ?>">Best Alternatives Review</a>
                </div>
                <nav id="site-navigation">
                    <button>Menu</button>
                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'main',
                            'menu_id' => 'primary-menu',
                            'menu_class' => 'navbar',
                            'container_class' => 'nav-container'
                        )
                    );
                    ?>
                </nav>
            </div>
            <!-- Heading and breadcrumbs -->
            <div class="hero-section">
                <?php
                if ('top-picks' == get_post_type() && is_post_type_archive() == false) {
                    if (!empty(get_field('p_h1'))) {
                        echo '<h1>' . get_field('p_h1') . '</h1>';
                        echo '<h4>of ' . date('F Y') . '</h4>';
                    }
                } elseif ('post' == get_post_type() || is_front_page() || is_page('category')) {
                    the_title('<h1>', '</h1>');
                } elseif (is_category()) { ?>
                    <h1><?php single_cat_title(); ?></h1>
                <?php } ?>
                <?php if (is_post_type_archive()) { ?>
                    <h1><?php post_type_archive_title(); ?></h1>
                <?php } ?>
                <?php if (function_exists('seopress_display_breadcrumbs')) {
                    seopress_display_breadcrumbs();
                } ?>
            </div>
        </header>
    </div>
    <div class="disclaimer-container">
        <div class="disclaimer">
            <p>*Disclaimer: BestAlternativesReview earns a commission from qualifying purchases.</p>
        </div>
    </div>