<?php
/**
 * Abstract Block
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

abstract class AbstractBlock
{
    /**
     * Get Block HTML attributes
     *
     * @param array  $block The block settings and attributes.
     */
    protected static function getBlockHTMLAttributes($block)
    {
        $atts = [];
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
     * Name
     *
     * @var string
     */
    protected $name = '';

    /**
     * Title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * Constructor
     *
     * @param string $name
     * @param string $title
     * @param array  $args
     */
    public function __construct($name, $title, $args = [])
    {
        $args = wp_parse_args($args, [
            'description' => '',
        ]);

        $this->name        = $name;
        $this->title       = $title;
        $this->description = $args['description'];
    }

    /**
     * Register block type
     *
     * @uses acf_register_block_type
     */
    public function registerBlockType()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type(array(
                'name'              => $this->name,
                'title'             => $this->title,
                'description'       => $this->description,
                'render_callback'   => [$this, 'render'],
                'category'          => 'common',
                'enqueue_assets'    => [$this, 'enqueueAssets'],
            ));
        }
    }

    /**
     * Render
     *
     * @param array  $block The block settings and attributes.
     * @param string $content The block inner HTML (empty).
     * @param bool   $is_preview True during AJAX preview.
     * @param mixed  $post_id The post ID this block is saved to.
     */
    abstract public function render($block, $content = '', $is_preview = false, $post_id = 0);

    /**
     * Enqueue assets
     */
    public function enqueueAssets()
    {
    }
}
