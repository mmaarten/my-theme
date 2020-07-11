<?php
/**
 * Modal
 *
 * Dependency: Advanced Custom Fields PRO
 *
 * @link https://www.advancedcustomfields.com/pro
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

use function My\Theme\carousel;

class Carousel extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('carousel');
    }

    public function renderItem($item, $index)
    {
        $item = wp_parse_args($item, [
            'image'      => 0,
            'image_size' => 'my-theme-full-width',
            'caption'    => '',
        ]);

        list($image_url) = wp_get_attachment_image_src($item['image'], $item['image_size']);

        $atts = [
            'class' => 'bg-cover bg-center embed-responsive embed-responsive-16by9',
        ];

        if ($image_url) {
            $atts['style'] = sprintf('background-image:url(%s);', esc_url($image_url));
        }

        echo '<div ' . acf_esc_attr($atts) . '>';

        if ($item['caption']) {
            printf('<div class="carousel-caption d-none d-md-block">%s</div>', $item['caption']);
        }

        echo '</div>';
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

        carousel([
            'id'              => get_field('id'),
            'items'           => get_field('items'),
            'indicators'      => get_field('indicators'),
            'controls'        => get_field('controls'),
            'autoplay'        => get_field('autoplay'),
            'render_callback' => [$this, 'renderItem'],
        ]);

        echo '</div>';
    }
}
