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

        $atts['class'] = 'wp-block-' . str_replace('/', '-', $block->name);

        if (! empty($block->attributes['className'])) {
            $atts['class'] .= " {$block->attributes['className']}";
        }

        if (! empty($block->attributes['align'])) {
            $atts['class'] .= " align{$block->attributes['align']}";
        }

        if (! empty($block->attributes['anchor'])) {
            $atts['id'] = $block->attributes['anchor'];
        }

        return $atts;
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
            'enum' => ['left', 'center', 'right', 'wide', 'full'],
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
}
