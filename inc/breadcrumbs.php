<?php
/**
 * Breadcrumbs
 *
 * Dependency: Breadcrumb NavXT
 * @link https://wordpress.org/plugins/breadcrumb-navxt/
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Render
 *
 * @uses bcn_display_list()
 * @link https://getbootstrap.com/docs/4.0/components/breadcrumb/
 * @param string $before The HTML to render before the navigation.
 * @param string $after  The HTML to render after the navigation.
 */
function breadcrumb_nav($before = '', $after = '')
{
    // Check Dependency.
    if (! function_exists('bcn_display_list')) {
        trigger_error(
            // translators: %s: the name of the coding function.
            sprintf(__('function %s does not exist.', 'my-theme'), '<code>bcn_display_list</code>'),
            E_USER_WARNING
        );
        return;
    }

    // Get items. Arguments: return, linked, reverse and force.
    $items = bcn_display_list(true, true, false, false);

    // Stop when no items.
    if (! trim($items)) {
        return;
    }

    // Add CSS classes.
    $items = str_replace('<li class="', '<li class="breadcrumb-item ', $items);
    $items = preg_replace('/class="(.*?)current-item(.*?)"/', 'class="$1active$2"', $items);

    ?>

    <?php echo $before; ?>

    <nav class="breadcrumb-nav" aria-label="breadcrumb">

        <ol class="breadcrumb">

        <?php echo $items; ?>

        </ol><!-- .breadcrumb -->

    </nav><!-- .breadcrumb-nav -->

    <?php echo $after; ?>

    <?php
}

/**
 * Adds 'Bootstrap' option to the Breadcrumb NavXT widget type list.
 */
function breadcrumb_widget_display_types($instance)
{
    printf(
        '<option value="bootstrap"%s>%s</option>',
        selected('bootstrap', $instance['type'], false),
        esc_html_x('Bootstrap breadcrumb navigation', 'my-theme', 'Bootstrap: name of application')
    );
}

add_action('bcn_widget_display_types', __NAMESPACE__ . '\breadcrumb_widget_display_types');

/**
 * Renders our breadcrumb navigation by use of the Breadcrumb NavXT widget.
 */
function breadcrumb_widget_display_trail($instance)
{
    if ('bootstrap' === $instance['type']) {
        breadcrumb_nav();
    }
}

add_action('bcn_widget_display_trail', __NAMESPACE__. '\breadcrumb_widget_display_trail');
