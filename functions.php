<?php
if (!function_exists('starter_theme_setup')) :
    function starter_theme_setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Title from wordpress
        add_theme_support('title-tag');

        // Enable post thumbnails
        add_theme_support('post-thumbnails');

        // register main nav
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'starter-theme'),
            )
        );

        // valid HTML5 support for forms, comments
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    };
endif;
add_action('after_setup_theme', 'starter_theme_setup');

/**
 * Enqueue scripts and styles.
 */

function starter_theme_scripts()
{
    wp_enqueue_style('main', get_template_directory_uri() . '/src/css/main.css', array(), '1.0', 'all');
    wp_enqueue_script('main', get_template_directory_uri() . '/src/js/main.js', array('jquery'), 1.0, true);
}
add_action('wp_enqueue_scripts', 'starter_theme_scripts');
