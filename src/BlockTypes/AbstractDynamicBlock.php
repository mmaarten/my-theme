<?php
/**
 * Abstract block
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

abstract class AbstractDynamicBlock extends AbstractBlock
{
    /**
     * Get block HTML attributes
     *
     * @param WP_Block $block
     * @return array
     */
    protected static function getBlockHTMLAttributes($block)
    {
        $atts = [];

        return $atts;
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
            'render_callback' => $this->getBlockTypeRenderCallback()
        ]);
    }

    /**
     * Get block type attributes
     *
     * @return array
     */
    protected function getBlockTypeAttributes()
    {
        return [];
    }

    /**
     * Get the schema for the alignment property.
     *
     * @return array Property definition for align.
     */
    protected function getSchemaAlign()
    {
        return array(
            'type' => 'string',
            'enum' => array( 'left', 'center', 'right', 'wide', 'full' ),
        );
    }

    /**
     * Get the schema for a boolean value.
     *
     * @param  string $default  The default value.
     * @return array Property definition.
     */
    protected function getSchemaBoolean($default = true)
    {
        return array(
            'type'    => 'boolean',
            'default' => $default,
        );
    }

    /**
     * Get the schema for a numeric value.
     *
     * @param  string $default  The default value.
     * @return array Property definition.
     */
    protected function getSchemaNumber($default)
    {
        return array(
            'type'    => 'number',
            'default' => $default,
        );
    }

    /**
     * Get the schema for a string value.
     *
     * @param  string $default  The default value.
     * @return array Property definition.
     */
    protected function getSchemaString($default = '')
    {
        return array(
            'type'    => 'string',
            'default' => $default,
        );
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
    abstract protected function render($attributes, $content, $block);
}
