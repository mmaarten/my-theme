<?php
/**
 * Spacer
 *
 * @package My/Theme
 */

namespace My\Theme\BlockTypes;

class Spacer extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('spacer');
    }

    /**
     * Render Block Callback.
     *
     * @param array $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool $is_preview True during AJAX preview.
     * @param (int|string) $post_id The post ID this block is saved to.
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $size = get_field('size');

        $atts = $this->getHTMLAttributes($block);

        if ($size) {
            $atts['class'] .= sprintf(' has-spacing-%d', $size);
        }

        echo '<div ' . acf_esc_attr($atts) . '></div>';
    }
}
