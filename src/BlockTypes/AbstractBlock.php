<?php
/**
 * Abstract block
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

abstract class AbstractBlock
{
    /**
     * Namespace
     *
     * @var string
     */
    protected $namespace = 'my';

    /**
     * Block name
     *
     * @var string
     */
    protected $block_name = '';

    /**
     * Constructor
     *
     * @param string $block_name
     */
    public function __construct($block_name)
    {
        $this->block_name = $block_name;
    }

    /**
     * Register block type
     */
    public function registerBlockType()
    {
        register_block_type($this->getBlockType(), [
            'render_callback' => $this->getBlockTypeRenderCallback(),
            'attributes'      => $this->getBlockTypeAttributes(),
            'editor_script'   => $this->getBlockTypeEditorScript(),
            'editor_style'    => $this->getBlockTypeEditorStyle(),
            'script'          => $this->getBlockTypeScript(),
            'style'           => $this->getBlockTypeStyle(),
            'supports'        => $this->getBlockTypeSupports(),
        ]);
    }

    /**
     * Render
     *
     * @param array    $attributes
     * @param string   $content.
     * @param WP_Block $block
     */
    protected function render($attributes, $content, $block)
    {
    }

    /**
     * Get block type
     */
    protected function getBlockType()
    {
        return $this->namespace . '/' . $this->block_name;
    }

    /**
     * Get block type attributes
     *
     * @return array|null
     */
    protected function getBlockTypeAttributes()
    {
        return null;
    }

    /**
     * Get block type render callback
     *
     * @return callable
     */
    protected function getBlockTypeRenderCallback()
    {
        return [$this, 'render'];
    }

    /**
     * Get block type editor script
     *
     * @return array|string
     */
    protected function getBlockTypeEditorScript()
    {
        return 'my-theme-editor';
    }

    /**
     * Get block type editor style
     *
     * @return array|string
     */
    protected function getBlockTypeEditorStyle()
    {
        return 'my-theme-editor';
    }

    /**
     * Get block type script
     *
     * @return array|string
     */
    protected function getBlockTypeScript()
    {
        return 'my-theme-blocks';
    }

    /**
     * Get block type style
     *
     * @return array|string
     */
    protected function getBlockTypeStyle()
    {
        return 'my-theme-blocks';
    }

    /**
     * Get block type supports
     *
     * @return array
     */
    protected function getBlockTypeSupports()
    {
        return [];
    }
}
