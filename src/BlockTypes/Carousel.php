<?php
/**
 * Carousel
 *
 * @package My\Theme
 */

namespace My\Theme\BlockTypes;

use \My\Theme\Templates;

class Carousel extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('carousel');
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

        Templates::carousel([
            'id'              => get_field('id'),
            'items'           => get_field('items'),
            'controls'        => get_field('controls'),
            'indicators'      => get_field('indicators'),
            'autoplay'        => get_field('autoplay'),
            'render_callback' => [$this, 'renderCarouselItem'],
        ]);

        echo '</div>';
    }

    /**
     * Render Carousel Item
     *
     * @param array $item
     * @param int   $index
     */
    public function renderCarouselItem($item, $index)
    {
        $item = wp_parse_args($item, [
            'image'   => 0,
            'caption' => '',
        ]);

        list($image_url) = wp_get_attachment_image_src($item['image'], 'my-theme-full-width');

        $atts = [
            'class' => 'embed-responsive embed-responsive-16by9 bg-cover bg-center',
        ];

        if ($image_url) {
            $atts['style'] = sprintf('background-image:url(%s);', esc_url($image_url));
        }

        echo '<div ' . acf_esc_attr($atts) . '>';

        echo wp_get_attachment_image($item['image'], 'my-theme-full-width', false, [
            'class' => 'embed-responsive-item',
            'style' => 'opacity:0;',
        ]);

        if ($item['caption']) {
            printf('<div class="carousel-caption d-none d-md-block">%s</div>', $item['caption']);
        }

        echo '</div>';
    }
}
