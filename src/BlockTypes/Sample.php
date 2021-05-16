<?php
/**
 * Sample
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

class Sample extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('sample', __('Sample', 'my-theme'), [
            'description' => __('Sample block', 'my-theme'),
        ]);
    }

    /**
     * Render
     *
     * @param   array      $block      The block settings and attributes.
     * @param   string     $content    The block inner HTML (empty).
     * @param   bool       $is_preview True during AJAX preview.
     * @param   int|string $post_id    The post ID this block is saved to.
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $atts = self::getBlockHTMLAttributes($block);

        echo '<div ' . acf_esc_attr($atts) . '>';

        var_dump($block);

        echo '</div>';
    }
}
