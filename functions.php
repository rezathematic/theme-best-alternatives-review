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

        // Support menu
        add_theme_support('menus');

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
 * Add global tags to the head
 */
function head_global_tags()
{
?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
<?php
}
add_action('wp_head', 'head_global_tags');

/**
 * Enqueue scripts and styles.
 */
function starter_theme_scripts()
{
    // wp_enqueue_style('main', get_template_directory_uri() . '/src/css/home.css', array(), '1.0', 'all');
    wp_enqueue_style('roundup', get_template_directory_uri() . '/src/css/roundup.css', array(), '1.0', 'all'); // TODO
    if ('top-picks' == get_post_type()) {
        wp_enqueue_style('roundup', get_template_directory_uri() . '/src/css/roundup.css', array(), '1.0', 'all');
    }
    wp_enqueue_script('main', get_template_directory_uri() . '/src/js/main.js', array('jquery'), 1.0, true);
    wp_scripts()->add_data('jquery', 'group', 1);
    wp_scripts()->add_data('jquery-core', 'group', 1);
    wp_scripts()->add_data('jquery-migrate', 'group', 1);
}
add_action('wp_enqueue_scripts', 'starter_theme_scripts');

// Disable UNUSED stylesheet
function disable_scripts_styles()
{
    wp_dequeue_script('wp-embed'); // Wordpress core
    wp_dequeue_style('wp-block-library'); // Wordpress core
    wp_dequeue_style('wp-block-library-theme'); // Wordpress core
    wp_dequeue_style('aawp'); // AAWP plugin
}
add_action('wp_enqueue_scripts', 'disable_scripts_styles', 100);

// Disable Embeds
function disable_embeds_code_init()
{

    // // Remove the REST API endpoint.
    // remove_action('rest_api_init', 'wp_oembed_register_route');

    // // Turn off oEmbed auto discovery.
    // add_filter('embed_oembed_discover', '__return_false');

    // // Don't filter oEmbed results.
    // remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // // Remove oEmbed discovery links.
    // remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
    // add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');

    // // Remove all embeds rewrite rules.
    // add_filter('rewrite_rules_array', 'disable_embeds_rewrites');

    // // Remove filter of the oEmbed result before any HTTP requests are made.
    // remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
}

add_action('init', 'disable_embeds_code_init', 9999);

// Disable oEmbed emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
