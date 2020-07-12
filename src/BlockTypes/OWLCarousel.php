<?php
/**
 * OWLCarousel
 *
 * Dependency: Advanced Custom Fields PRO
 *
 * @link https://www.advancedcustomfields.com/pro
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

use function My\Theme\gallery;

class OWLCarousel extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('owl-carousel');
    }

    public function renderCarousel($args)
    {
        static $instance = 0;

        $instance++;

        $args = wp_parse_args($args, [
            'id'              => '',
            'indicators'      => false,
            'controls'        => true,
            'autoplay'        => true,
            'items'           => [],
            'items_visible'   => 4,
            'render_callback' => null,
        ]);

        $carousel_id = !empty($args['id']) ? $args['id'] : "owl-carousel-$instance";
        $items = is_array($args['items']) ? $args['items'] : [];

        $atts = [
            'id'    => $carousel_id,
            'class' => 'owl-carousel owl-theme',
        ];

        echo '<div ' . acf_esc_attr($atts) . '>';

        foreach ($items as $item) {
            echo '<div class="item">';

            if (is_callable($args['render_callback'])) {
                call_user_func($args['render_callback'], $item);
            }

            echo '</div>';
        }

        echo '</div>'; // .owl-carousel

        $js_options = [
            'autoplay'   => $args['autoplay'] ? 1 : 0,
            'dots'       => $args['indicators'] ? 1 : 0,
            'nav'        => $args['controls'] ? 1 : 0,
            'responsive' => [],
        ];

        if (! is_array($args['items_visible'])) {
            if (strpos($args['items_visible'], '=') !== false) {
                $items_visible = wp_parse_args($args['items_visible']);
            } else {
                $items_visible = ['xs' => $args['items_visible']];
            }
        } else {
            $items_visible = $args['items_visible'];
        }

        $breakpoints = [
            'xs' => 0,
            'sm' => 576,
            'md' => 768,
            'lg' => 992,
            'xl' => 1200,
        ];

        foreach ($breakpoints as $breakpoint => $max_width) {
            if (isset($items_visible[$breakpoint])) {
                $js_options['responsive'][$max_width]['items'] = $items_visible[$breakpoint];
            }
        }

        ?>

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', function(event) {
                jQuery('#<?php echo esc_attr($carousel_id); ?>').owlCarousel(<?php echo json_encode($js_options); ?>)
            });

        </script>

        <?php
    }

    public function renderItem($item)
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

        $this->renderCarousel([
            'id'              => get_field('id'),
            'indicators'      => get_field('indicators'),
            'controls'        => get_field('controls'),
            'autoplay'        => get_field('autoplay'),
            'items'           => get_field('items'),
            'items_visible'   => get_field('items_visible'),
            'render_callback' => [$this, 'renderItem'],
        ]);

        echo '</div>';
    }

    /**
     * Enqueues scripts and styles for front-end and back-end.
     */
    public function enqueueAssets()
    {
        wp_enqueue_script('owl-carousel');
        wp_enqueue_style('owl-carousel');
    }
}
