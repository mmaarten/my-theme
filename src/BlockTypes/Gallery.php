<?php
/**
 * Gallery
 *
 * Dependency: Advanced Custom Fields PRO
 *
 * @link https://www.advancedcustomfields.com/pro
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

use function My\Theme\gallery;

class Gallery extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('gallery');
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
        /**
         * HTML Attributes
         */

        $atts = $this->getHTMLAttributes($block);

        /**
         * Output
         */

        echo '<div ' . acf_esc_attr($atts) . '>';

        gallery([
            'id'      => get_field('id'),
            'columns' => get_field('columns'),
            'size'    => get_field('size'),
            'link'    => get_field('link'),
            'ids'     => get_field('attachments'),
        ]);

        echo '</div>';
    }

    /**
     * Enqueues scripts and styles for front-end and back-end.
     */
    public function enqueueAssets()
    {
        wp_enqueue_script('fancybox');
        wp_enqueue_style('fancybox');
    }
}
