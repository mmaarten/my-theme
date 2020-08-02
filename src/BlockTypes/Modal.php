<?php
/**
 * Modal
 *
 * @package My\Theme
 */

namespace My\Theme\BlockTypes;

use \My\Theme\Templates;

class Modal extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('modal');
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
        $atts = $this->getHTMLAttributes($block);

        echo '<div ' . acf_esc_attr($atts) . '>';

        Templates::modal([
            'id'     => get_field('id'),
            'title'  => get_field('title'),
            'body'   => get_field('body'),
            'size'   => get_field('size'),
            'center' => get_field('center'),
        ]);

        echo '</div>';
    }
}
