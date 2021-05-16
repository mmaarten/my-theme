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
            'script'        => $this->getBlockTypeScript(),
            'style'         => $this->getBlockTypeStyle(),
            'editor_script' => $this->getBlockTypeEditorScript(),
            'editor_style'  => $this->getBlockTypeEditorStyle(),
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
}
