<?php
/**
 * Login Form
 *
 * @package My/Theme
 */

function login_header_url()
{
    return home_url();
}

add_filter('login_headerurl', __NAMESPACE__ . '\login_header_url');

function login_header_title()
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', __NAMESPACE__ . '\login_header_title');

function login_enqueue_scripts()
{
    $logo_url = null;

    if (has_custom_logo()) {
        list($logo_url) = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
    }

    if (! $logo_url) {
        return;
    }

    ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($logo_url); ?>);
                background-size: contain;
                background-repeat: no-repeat;
                width: auto;
            }
        </style>
    <?php
}
add_action('login_enqueue_scripts', __NAMESPACE__ . '\login_enqueue_scripts');
