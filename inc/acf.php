<?php
/**
 * ACF
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Update Settings
 */
add_action('acf/init', function () {
    if (function_exists('acf_update_setting')) {
        // acf_update_setting('google_api_key', 'xxx');
    }
});

/**
 * Add Options Page
 */
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title'  => __('Site Options', 'my-theme'),
            'menu_title'  => __('Site Options', 'my-theme'),
            'menu_slug'   => 'theme-options',
            'parent_slug' => null,
        ]);
    }
});

/**
 * Alter field settings
 *
 * @param array $field
 * @return array
 */
add_filter('acf/load_field', function ($field) {

    // Populate select field with editor color names. Usage: set field CSS class to my-theme-editor-colors.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-editor-colors( |$)/', $field['wrapper']['class'])) {
        if (current_theme_supports('editor-color-palette')) {
            $field['choices'] = wp_list_pluck(get_theme_support('editor-color-palette')[0], 'name', 'slug');
        }
    }

    // Populate select field with editor font size names. Usage: set field CSS class to my-theme-editor-font-sizes.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-editor-font-sizes( |$)/', $field['wrapper']['class'])) {
        if (current_theme_supports('editor-font-sizes')) {
            $field['choices'] = wp_list_pluck(get_theme_support('editor-font-sizes')[0], 'name', 'slug');
        }
    }

    // Populate select field with image size names. Usage: set field CSS class to my-theme-image-sizes.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-image-sizes( |$)/', $field['wrapper']['class'])) {
        $field['choices'] = apply_filters('image_size_names_choose', [
            'thumbnail' => __('Thumbnail', 'my-theme'),
            'medium'    => __('Medium', 'my-theme'),
            'large'     => __('Large', 'my-theme'),
            'full'      => __('Full Size', 'my-theme'),
        ]);
    }

    // Populate select field with icon names. Usage: set field CSS class to my-theme-icons.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-icons( |$)/', $field['wrapper']['class'])) {
        $choices = [];
        $icons = get_icons();
        foreach ($icons as $key => $svg) {
            $choices[$key] = ucwords(str_replace(['-', '_'], ' ', $key));
        }
        $field['choices'] = $choices;
    }

    return $field;
}, PHP_INT_MAX);

/**
 * Nav Menu Link Attributes
 *
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
add_filter('nav_menu_link_attributes', function ($atts, $item, $nav_menu, $depth) {

    // Check dependency.
    if (! function_exists('get_field')) {
        return $atts;
    }

    // Make sure 'class' attribute is set.
    if (! isset($atts['class'])) {
        $atts['class'] = '';
    }

    /**
     * Button
     * -----------------------------------------------------------------------------------------------------------------
     */

    $options = get_field('button', $item);

    if ($options && $options['type']) {
        $btn_classes = ['btn'];

        if ($options['outline']) {
            $btn_classes[] = "btn-outline-{$options['type']}";
        } else {
            $btn_classes[] = "btn-{$options['type']}";
        }

        if ($options['size']) {
            $btn_classes[] = "btn-{$options['size']}";
        }

        // Remove 'nav-link' class
        $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);

        // Add button attributes
        $atts['class'] .= ' ' . implode(' ', $btn_classes);
        $atts['role'] = 'button';
    }

    /**
     * Disable
     * -----------------------------------------------------------------------------------------------------------------
     */

    if (get_field('disable', $item)) {
        $atts['class'] .= ' disabled';
        $atts['rel'] = 'nofollow';
    }

    /**
     * Toggle
     * -----------------------------------------------------------------------------------------------------------------
     */

    $toggle = get_field('toggle', $item);

    if ($toggle) {
        $atts['data-toggle'] = $toggle;
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    // Sanitize 'class' attribute.
    $atts['class'] = trim($atts['class']);

    return $atts;
}, PHP_INT_MAX, 4);

/**
 * Nav Menu Item Title
 *
 * @param string   $title     The menu item's title.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item. Used for padding.
 */
add_filter('nav_menu_item_title', function ($title, $item, $nav_menu, $depth) {

    // Check dependency.
    if (! function_exists('get_field')) {
        return $title;
    }

    /**
     * Icon
     * -----------------------------------------------------------------------------------------------------------------
     */

    $options = get_field('icon', $item);

    if ($options && $options['type']) {
        if ($options['hide_title']) {
            $title = sprintf('<span class="sr-only">%s</span>', $title);
        }
        $icon = get_icon($options['type']);
        if ($icon) {
            if ('left' == $options['position']) {
                $title = "$icon $title";
            } else {
                $title = "$title $icon";
            }
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    return $title;
}, PHP_INT_MAX, 4);
