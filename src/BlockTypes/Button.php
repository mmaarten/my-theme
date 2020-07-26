<?php

namespace My\Theme\BlockTypes;

class Button extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('button');
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
        $align = get_field('align');

        $atts = $this->getHTMLAttributes($block);

        if ($align) {
            $atts['class'] .= " text-$align";
        }

        echo '<div ' . acf_esc_attr($atts) . '>';

        $this->renderButton([
            'text'     => get_field('text'),
            'link'     => get_field('link'),
            'link_tab' => get_field('link_tab'),
            'type'     => get_field('type'),
            'outline'  => get_field('outline'),
            'size'     => get_field('size'),
            'toggle'   => get_field('toggle'),
        ]);

        echo '</div>';
    }

    /**
     * Render Button
     *
     * @param array $args
     */
    public function renderButton($args)
    {
        $args = wp_parse_args($args, [
            'text'     => '',
            'link'     => '',
            'link_tab' => false,
            'type'     => 'primary',
            'outline'  => false,
            'size'     => '',
            'toggle'   => '',
        ]);

        $atts = [
            'class' => 'btn',
            'role'  => 'button',
        ];

        if ($args['link']) {
            $atts['href'] = esc_url($args['link']);
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

        if ($args['toggle']) {
            $atts['data-toggle'] = $args['toggle'];
        }

        echo '<a ' . acf_esc_attr($atts) . '>' . $args['text'] . '</a>';
    }
}
