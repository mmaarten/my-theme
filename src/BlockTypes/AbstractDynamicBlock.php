<?php
/**
 * Abstract dynamic block
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

abstract class AbstractDynamicBlock extends AbstractBlock
{
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
     * Get block type script
     *
     * @return null
     */
    protected function getBlockTypeScript()
    {
        return null;
    }

    /**
     * Get the schema for the alignment property.
     *
     * @return array Property definition for align.
     */
    protected function getSchemaAlign()
    {
        return [
            'type' => 'string',
            'enum' => ['left', 'center', 'right', 'wide', 'full'],
        ];
    }

    /**
     * Get the schema for a boolean value.
     *
     * @param  string $default  The default value.
     * @return array Property definition.
     */
    protected function getSchemaBoolean($default = true)
    {
        return [
            'type'    => 'boolean',
            'default' => $default,
        ];
    }

    /**
     * Get the schema for a numeric value.
     *
     * @param  string $default  The default value.
     * @return array Property definition.
     */
    protected function getSchemaNumber($default)
    {
        return [
            'type'    => 'number',
            'default' => $default,
        ];
    }

    /**
     * Get the schema for a string value.
     *
     * @param  string $default  The default value.
     * @return array Property definition.
     */
    protected function getSchemaString($default = '')
    {
        return [
            'type'    => 'string',
            'default' => $default,
        ];
    }
}
