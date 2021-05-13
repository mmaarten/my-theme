<?php
/**
 * Button Block
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

class Buttons extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('buttons', __('Buttons', 'my-theme'), [
            'description' => __('Displays buttons.', 'my-theme'),
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
     * @uses get_sub_field
     * @uses have_rows
     * @uses the_row
     */
    public function render($block, $content = '', $is_preview = false, $post_id = 0)
    {
        $align = get_field('align');

        $atts = self::getBlockHTMLAttributes($block);

        if ($align) {
            $atts['class'] .= " text-{$align}";
        }

        echo '<div ' . acf_esc_attr($atts) . '>';

        if (have_rows('buttons')) {
            echo '<ul class="list-inline m-0">';
            while (have_rows('buttons')) {
                the_row();
                echo '<li class="list-inline-item">';
                self::renderButton([
                    'text'     => get_sub_field('text'),
                    'link'     => get_sub_field('link'),
                    'link_tab' => get_sub_field('link_tab'),
                    'type'     => get_sub_field('type'),
                    'outline'  => get_sub_field('outline'),
                    'size'     => get_sub_field('size'),
                    'block'    => get_sub_field('block'),
                    'toggle'   => get_sub_field('toggle'),
                ]);
                echo '</li>';
            }
            echo '</ul>';
        }

        echo '</div>';
    }

    /**
     * Render button
     *
     * @param array $args
     *
     * @uses acf_esc_attr
     */
    protected function renderButton($args)
    {
        $args = wp_parse_args($args, [
            'text'     => '',
            'link'     => '',
            'link_tab' => false,
            'type'     => 'primary',
            'outline'  => false,
            'size'     => '',
            'block'    => false,
            'toggle'   => '',
        ]);

        $atts = ['class' => 'btn', 'role'  => 'button'];

        if ($args['link']) {
            $atts['href'] = $args['link'];
        }

        if ($args['link_tab']) {
            $atts['target'] = '_blank';
        }

        if ($args['type']) {
            if ($args['outline']) {
                $atts['class'] .= " btn-outline-{$args['type']}";
            } else {
                $atts['class'] .= " btn-{$args['type']}";
            }
        }

        if ($args['size']) {
            $atts['class'] .= " btn-{$args['size']}";
        }

        if ($args['block']) {
            $atts['class'] .= ' btn-block';
        }

        if ($args['toggle']) {
            $atts['data-toggle'] = $args['toggle'];
        }

        echo '<a ' . acf_esc_attr($atts) . '>' . esc_html($args['text']) . '</a>';
    }
}
