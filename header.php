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
    <div class="header-container">
        <header>
            <!-- Navbar -->
            <div class="header">
                <div>
                    <img src="https://toybin.org/wp-content/uploads/2021/08/Toybin-logo-125x125-1.png" alt="">
                </div>
                <nav id="site-navigation">
                    <button>Expand</button>
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
                if ('top-picks' == get_post_type()) {
                    if (!empty(get_field('p_h1'))) {
                        echo '<h1>' . get_field('p_h1') . '</h1>';
                        echo '<h4>of ' . date('F Y') . '</h4>';
                    }
                } elseif ('post' == get_post_type()) {
                    the_title('<h1>', '</h1>');
                } else {
                    echo 'Butts';
                }
                ?>
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