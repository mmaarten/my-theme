<?php
/**
 * Abstract block.
 *
 * @package My/Theme
 */

namespace My\Theme\BlockTypes;

abstract class AbstractBlock
{
    /**
     * Block namespace.
     *
     * @var string
     */
    protected $namespace = 'my-theme';

    /**
     * Block name.
     *
     * @var string
     */
    protected $block_name = '';

    /**
     * Registers the block type with WordPress.
     */
    public function registerBlockType()
    {
        register_block_type(
            $this->namespace . '/' . $this->block_name,
            array(
                'editor_script' => 'my-theme-' . $this->block_name . '-block',
                'editor_style'  => 'my-theme-block-editor',
                'style'         => 'my-theme-block-style',
            )
        );
    }
}
