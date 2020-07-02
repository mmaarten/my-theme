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
 * Convert a menu item link to a button.
 *
 * This feature can be applied by using menu item 'CSS Classes' setting in admin area.
 *
 * Usage: Use button CSS classes prefixed by a dash character '-'.
 *
 * e.g. '-btn -btn-primary -btn-sm' adds link CSS classes 'btn btn-primary btn-sm'.
 *
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
add_filter('nav_menu_link_attributes', function ($atts, $item, $nav_menu, $depth) {

    // Get button classes

    $btn_classes = array();

    foreach ($item->classes as $class) {
        if (preg_match('/^-(btn-[\w-]+)$/', $class, $matches)) {
            $btn_classes[ $matches[1] ] = $matches[1];
        }
    }

    // Stop when no classes

    if (! $btn_classes) {
        return $atts;
    }

    // Make sure 'btn' class is added

    $btn_classes = ['btn' => 'btn'] + $btn_classes;

    // Make sure 'class' attribute is set.

    if (! isset($atts['class'])) {
        $atts['class'] = '';
    }

    // Remove 'nav-link' class

    $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);

    // Add button attributes

    $atts['class'] .= ' ' . implode(' ', $btn_classes);

    $atts['role'] = 'button';

    // Sanitize 'class' attribute.

    $atts['class'] = trim($atts['class']);

    // Return

    return $atts;
}, PHP_INT_MAX, 4);
