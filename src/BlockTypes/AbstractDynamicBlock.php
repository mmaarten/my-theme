<?php
/**
 * Abstract dynamic block.
 *
 * @package My/Theme
 */

namespace My\Theme\BlockTypes;

abstract class AbstractDynamicBlock extends AbstractBlock
{
    /**
     * Get block attributes.
     *
     * @return array
     */
    protected function getAttributes()
    {
        return [];
    }

    /**
     * Registers the block type with WordPress.
     */
    public function registerBlockType()
    {
        register_block_type(
            $this->namespace . '/' . $this->block_name,
            [
                'render_callback' => [$this, 'render'],
                'editor_script'   => 'my-theme-' . $this->block_name . '-block',
                'editor_style'    => 'my-theme-block-editor',
                'style'           => 'my-theme-block-style',
                'attributes'      => $this->getAttributes(),
            ]
        );
    }

    /**
     * Include and render a dynamic block.
     *
     * @param array  $attributes Block attributes. Default empty array.
     * @param string $content    Block content. Default empty string.
     * @return string Rendered block type output.
     */
    abstract public function render($attributes = [), $content = '');
}
