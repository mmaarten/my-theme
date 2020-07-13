<?php
/**
 * Button
 *
 * Dependency: Advanced Custom Fields PRO
 *
 * @link https://www.advancedcustomfields.com/pro
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

use function My\Theme\button;

class Button extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('button');
    }

    /**
     * Render Button
     *
     * @link https://getbootstrap.com/docs/4.0/components/buttons/
     * @uses acf_esc_attr()
     * @param array $args
     */
    public function renderButton($args)
    {
        /**
         * Arguments
         */

        $args = wp_parse_args($args, [
            'text'     => '',
            'link'     => '',
            'link_tab' => false,
            'type'     => 'primary',
            'outline'  => false,
            'size'     => '',
            'toggle'   => '',
        ]);

        /**
         * HTML Attributes
         */

        $atts = ['class' => 'btn', 'role' => 'button'];

        // Type
        if ($args['type']) {
            if ($args['outline']) {
                $atts['class'] .= " btn-outline-{$args['type']}";
            } else {
                $atts['class'] .= " btn-{$args['type']}";
            }
        }

        // Size
        if ($args['size']) {
            $atts['class'] .= " btn-{$args['size']}";
        }

        // Link
        if ($args['link']) {
            $atts['href'] = esc_url($args['link']);
        }

        // Open link in new window.
        if ($args['link_tab']) {
            $atts['target'] = '_blank';
        }

        // Toggle
        if ($args['toggle']) {
            $atts['data-toggle'] = $args['toggle'];
        }

        /**
         * Output
         */

        echo '<a ' . acf_esc_attr($atts) . '>' . $args['text'] . '</a>';
    }

    /**
     * Render Block Callback.
     *
     * @uses get_field()
     * @uses acf_esc_attr()
     * @param array $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool $is_preview True during AJAX preview.
     * @param (int|string) $post_id The post ID this block is saved to.
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $align = get_field('align');

        /**
         * HTML Attributes
         */

        $atts = $this->getHTMLAttributes($block);

        if ($align) {
            $atts['class'] .= " text-{$align}";
        }

        /**
         * Output
         */

        echo '<div ' . acf_esc_attr($atts) . '>';

        $this->renderButton([
            'text'     => get_field('text'),
            'link'     => get_field('link'),
            'link_tab' => get_field('link_tab'),
            'type'     => get_field('type'),
            'outline'  => get_field('outline'),
            'size'     => get_field('size'),
            'toggle'   => get_field('toggle'),
        ]);

        echo '</div>';
    }
}
