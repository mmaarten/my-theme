<?php
/**
 * Spacer Block
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

class Spacer extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('spacer', __('Spacer', 'my-theme'), [
            'description' => __('Displays a spacer.', 'my-theme'),
        ]);
    }

    /**
     * Render
     *
     * @param array  $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool   $is_preview True during AJAX preview.
     * @param mixed  $post_id The post ID this block is saved to.
     *
     * @uses acf_esc_attr
     * @uses get_field
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $sizes = get_field('sizes');

        $atts = self::getBlockHTMLAttributes($block);
        $atts['aria-hidden'] = 'true';

        if (is_array($sizes)) {
            foreach ($sizes as $breakpoint => $size) {
                if ($size !== '') {
                    $infix = 'xs' === $breakpoint ? '' : "-$breakpoint";
                    $atts['class'] .= " has-spacing{$infix}-$size";
                }
            }
        }

        echo '<div ' . acf_esc_attr($atts) . '></div>';
    }
}
