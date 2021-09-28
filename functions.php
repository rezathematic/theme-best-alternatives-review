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
    <style>body{font-family: sans-serif;}</style>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" />
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TMJPWFV');</script>
    <!-- End Google Tag Manager -->
<?php
}
add_action('wp_head', 'head_global_tags');

/**
 * Enqueue scripts and styles.
 */
function starter_theme_scripts()
{
    // wp_enqueue_style('main', get_template_directory_uri() . '/src/css/home.css', array(), '1.0', 'all'); // TODO
    wp_enqueue_style('roundup', get_template_directory_uri() . '/src/css/roundup.css', array(), '1.0', 'all'); // TEMP, TODO: create a global template for pages and other templates
    if ('top-picks' == get_post_type() || is_front_page()) {
        wp_enqueue_style('roundup', get_template_directory_uri() . '/src/css/roundup.css', array(), '1.0', 'all');
    }
    if (is_archive() || is_category()) {
        wp_dequeue_style('roundup');
        wp_enqueue_style('archive', get_template_directory_uri() . '/src/css/archive.css', array(), '1.0', 'all');
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

// Add Roundup Reviews Editor User Role
if (get_role('roundup_editor')) {
    remove_role('roundup_editor');
}

add_role("roundup_editor", "Roundup Editor", array(
    "read" => true,
    "read_roundups" => true,
    "edit_roundups" => true,
    "publish_roundups" => false,
    "read_private_roundups" => true,
    "edit_others_roundups" => true,
    "edit_published_roundups" => true,
    "delete_roundups" => false,
    "delete_others_roundups" => false,
    "delete_private_roundups" => false,
    "delete_published_roundups" => false,
));

// Extend role of admin to
function extend_admin_role() {
    
    $admin = get_role('administrator');
    $caps = array(
        "read" => true,
        "read_roundups" => true,
        "edit_roundups" => true,
        "publish_roundups" => true,
        "read_private_roundups" => true,
        "edit_others_roundups" => true,
        "edit_published_roundups" => true,
        "delete_roundups" => true,
        "delete_others_roundups" => true,
        "delete_private_roundups" => true,
        "delete_published_roundups" => true,
    );
    foreach($caps as $cap) {
        $admin->add_cap($cap);
    }
}
add_action('init', 'extend_admin_role');