<?php

namespace My\Theme;

/**
 * Set default walker
 *
 * @param array $args Array of wp_nav_menu() arguments.
 * @return array
 */
add_filter('wp_nav_menu_args', function ($args) {
    if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        $args['walker'] = new NavWalker();
    }
    return $args;
}, PHP_INT_MAX);

/**
 * Open modal on menu item click.
 *
 * Usage:
 * - Add CSS class toggle-modal.
 * - Set URL setting to refer to model. e.g. #my-modal
 *
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
add_filter('nav_menu_link_attributes', function (array $atts, \WP_Post $item, \stdClass $nav_menu, int $depth) {

    if (in_array('toggle-modal', $item->classes)) {
        $atts['data-toggle'] = 'modal';
    }

    return $atts;
}, PHP_INT_MAX, 4);

/**
 * Make item title only available for screenreaders.
 *
 * Use CSS class -sr-only.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 */
add_filter('nav_menu_item_title', function (string $title, \WP_Post $item, \stdClass $args, int $depth) {

    if (in_array('-sr-only', $item->classes)) {
        $title = sprintf('<span class="sr-only">%s</span>', $title);
    }

    return $title;
}, 5, 4);
