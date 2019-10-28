<?php
/**
 * Navs config
 *
 * @package My/Theme
 */

return [
    /**
     * List of nav menu locations to register.
     *
     * @var array
     */
    'nav_menus' => [
        'top-left'     => esc_html__('Top Left', 'my-theme'),
        'top-right'    => esc_html__('Top Right', 'my-theme'),
        'main-left'    => esc_html__('Primary Left', 'my-theme'),
        'main-right'   => esc_html__('Primary Right', 'my-theme'),
        'footer-left'  => esc_html__('Footer Left', 'my-theme'),
        'footer-right' => esc_html__('Footer Right', 'my-theme'),
    ],
];
