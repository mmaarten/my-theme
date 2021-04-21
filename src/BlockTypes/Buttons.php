<?php
/**
 * Buttons
 *
 * @package My/Theme
 */

namespace My\Theme\BlockTypes;

use \My\Theme\Templates;

class Buttons extends AbstractBlock
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('buttons');
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

        $atts = $this->getBlockHTMLAttributes($block);

        if ($align) {
            $atts['class'] .= " text-$align";
        }

        echo '<div ' . acf_esc_attr($atts) . '>';

        if (have_rows('buttons')) {
            echo '<ul class="list-inline m-0">';

            while (have_rows('buttons')) {
                the_row();

                echo '<li class="list-inline-item">';

                Templates::button([
                    'text'     => get_sub_field('text'),
                    'link'     => get_sub_field('link'),
                    'link_tab' => get_sub_field('link_tab'),
                    'type'     => get_sub_field('type'),
                    'outline'  => get_sub_field('outline'),
                    'size'     => get_sub_field('size'),
                    'toggle'   => get_sub_field('toggle'),
                ]);

                echo '</li>'; // .inline-list-item
            }

            echo '</ul>'; // .inline-list
        }

        echo '</div>';
    }
}
