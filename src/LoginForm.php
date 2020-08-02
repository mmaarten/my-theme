<?php
/**
 * Login Form
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form/
 * @package My\Theme
 */

namespace My\Theme;

class LoginForm
{
    public static function init()
    {
        add_filter('login_headerurl', [__CLASS__, 'headerURL'], PHP_INT_MAX);
        add_filter('login_header_title', [__CLASS__, 'headerTitle'], PHP_INT_MAX);
        add_action('login_enqueue_scripts', [__CLASS__, 'enqueueScripts']);
    }

    public static function headerURL()
    {
        return home_url();
    }

    public static function headerTitle()
    {
        return get_bloginfo('name');
    }

    public static function enqueueScripts()
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
}
