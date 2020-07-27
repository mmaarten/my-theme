<?php

namespace My\Theme\BlockTypes;

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

        $this->renderCarousel([
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
     * Render Carousel
     *
     * @param array $args
     */
    public function renderCarousel($args)
    {
        static $instance = 0;

        $instance++;

        $args = wp_parse_args($args, [
            'items'           => [],
            'controls'        => true,
            'indicators'      => false,
            'autoplay'        => true,
            'render_callback' => null,
        ]);

        $carousel_id = !empty($args['id']) ? $args['id'] : "carousel-$instance";
        $items       = is_array($args['items']) ? $args['items'] : [];

        if (! $items) {
            return;
        }

        $atts = [
            'id'    => $carousel_id,
            'class' => 'carousel slide',
        ];

        if ($args['autoplay']) {
            $atts['data-ride'] = 'carousel';
        }

        echo '<div ' . acf_esc_attr($atts) . '>';

        // Indicators
        if ($args['indicators']) {
            echo '<ol class="carousel-indicators">';
            for ($i=0; $i < count($items); $i++) {
                $is_active = $i === 0;
                $indicator_atts = [
                    'data-target' => "#$carousel_id",
                    'data-slide-to' => $i,
                ];
                if ($is_active) {
                    $indicator_atts['class'] = 'active';
                }
                echo '<li ' . acf_esc_attr($indicator_atts) . '></li>';
            }
            echo '</ol>'; // .carousel-indicators
        }

        // Items
        echo '<div class="carousel-inner">';

        for ($i=0; $i < count($items); $i++) {
            $item = $items[$i];
            $is_active = $i === 0;
            $item_atts = [
                'class' => 'carousel-item',
            ];
            if ($is_active) {
                $item_atts['class'] .= ' active';
            }

            echo '<div ' . acf_esc_attr($item_atts) . '>';

            if (is_callable($args['render_callback'])) {
                call_user_func($args['render_callback'], $item, $i);
            }

            echo '</div>'; // .carousel-item
        }

        echo '</div>'; // .carousel-inner

        // Controls
        if ($args['controls']) {
            echo '<a class="carousel-control-prev" href="#' . esc_attr($carousel_id) . '" role="button" data-slide="prev">';
            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
            echo '<span class="sr-only">' . esc_html__('Previous', 'my-theme') . '</span>';
            echo '</a>';
            echo '<a class="carousel-control-next" href="#' . esc_attr($carousel_id) . '" role="button" data-slide="next">';
            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
            echo '<span class="sr-only">' . esc_html__('Next', 'my-theme') . '</span>';
            echo '</a>';
        }

        echo '</div>'; // .carousel
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
