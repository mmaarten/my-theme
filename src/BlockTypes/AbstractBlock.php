<?php
/**
 * Abstract block
 *
 * @package My\Theme
 */

namespace My\Theme\BlockTypes;

abstract class AbstractBlock
{
    /**
     * Block name.
     *
     * @var string
     */
    protected $name = '';

    /**
     * Block title.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Block description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Constructor
     *
     * @param string $name
     * @param array  $args
     */
    public function __construct($name, $args = [])
    {
        $args = wp_parse_args($args, [
            'title'       => ucwords(str_replace(['-', '_'], ' ', $name)),
            'description' => '',
        ]);

        $this->name        = $name;
        $this->title       = $args['title'];
        $this->description = $args['description'];
    }

    /**
     * Get Block HTML Attributes.
     *
     * @param array $block
     * @return array
     */
    public function getHTMLAttributes($block)
    {
        $atts = [];

        // Add block specific class name. e.g. wp-block-acf-{name}
        $atts['class'] = 'wp-block-' . str_replace('/', '-', $block['name']);

        if (! empty($block['anchor'])) {
            $atts['id'] = $block['anchor'];
        }

        if (! empty($block['className'])) {
            $atts['class'] .= " {$block['className']}";
        }

        if (! empty($block['align'])) {
            $atts['class'] .= " align{$block['align']}";
        }

        return $atts;
    }

    /**
     * Registers the block type with WordPress.
     *
     * @uses acf_register_block_type()
     */
    public function registerBlockType()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name'            => $this->name,
                'title'           => $this->title,
                'description'     => $this->description,
                'render_callback' => [$this, 'render'],
                'enqueue_assets'  => [$this, 'enqueueAssets'],
                'category'        => 'common',
                'supports'        => [
                    'align'  => ['wide', 'full'],
                    'anchor' => true,
                ],
            ]);
        }
    }

    /**
     * Enqueues scripts and styles for front-end and back-end.
     */
    public function enqueueAssets()
    {
    }

    /**
     * Render Block Callback.
     *
     * @param array $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool $is_preview True during AJAX preview.
     * @param (int|string) $post_id The post ID this block is saved to.
     */
    abstract public function render($block, $content = '', $is_preview = false, $post_id = 0);
}
