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
    protected $namespace = 'my-theme';

    /**
     * Name
     *
     * @var string
     */
    protected $name = '';

    /**
     * Construct
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Register block type
     */
    public function registerBlockType()
    {
        register_block_type($this->getBlockTypeName(), [
            'script'          => $this->getBlockTypeScript(),
            'style'           => $this->getBlockTypeStyle(),
            'editor_script'   => $this->getBlockTypeEditorScript(),
            'editor_style'    => $this->getBlockTypeEditorStyle(),
            'attributes'      => $this->getBlockTypeAttributes(),
            'supports'        => $this->getBlockTypeSupports(),
            'render_callback' => $this->getBlockTypeRenderCallback(),
        ]);
    }

    /**
     * Get block type name
     *
     * @return string
     */
    protected function getBlockTypeName()
    {
        return $this->namespace . '/' . $this->name;
    }

    /**
     * Get block type script
     *
     * @return string|array
     */
    protected function getBlockTypeScript()
    {
        return 'my-theme-blocks-script';
    }

    /**
     * Get block type style
     *
     * @return string|array
     */
    protected function getBlockTypeStyle()
    {
        return 'my-theme-blocks-style';
    }

    /**
     * Get block type editor script
     *
     * @return string|array
     */
    protected function getBlockTypeEditorScript()
    {
        return 'my-theme-editor-script';
    }

    /**
     * Get block type editor style
     *
     * @return string|array
     */
    protected function getBlockTypeEditorStyle()
    {
        return 'my-theme-editor-style';
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
     * Get block type attributes
     *
     * @return array
     */
    protected function getBlockTypeSupports()
    {
        return [];
    }

    /**
     * Get block type render callback
     *
     * @return array
     */
    protected function getBlockTypeRenderCallback()
    {
        return [$this, 'render'];
    }

    /**
     * Render the block. Extended by children.
     *
     * @param array    $attributes Block attributes.
     * @param string   $content    Block content.
     * @param WP_Block $block
     * @return string Rendered block type output.
     */
    public function render($attributes, $content, $block)
    {
        return $content;
    }
}
