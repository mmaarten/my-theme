<?php
/**
 * Sample
 *
 * @package My/Theme/BlockTypes
 */

namespace My\Theme\BlockTypes;

use \My\Theme\Helpers;

class Sample extends AbstractDynamicBlock
{
    /**
     * Construct.
     */
    public function __construct()
    {
        parent::__construct('sample');
    }

    /**
     * Get block type attributes
     *
     * @return array
     */
    protected function getBlockTypeAttributes()
    {
        return [
            'attribute' => $this->getSchemaString(),
        ];
    }

    /**
     * Get block type attributes
     *
     * @return array
     */
    protected function getBlockTypeSupports()
    {
        return [
            'align'  => ['wide', 'full'],
            'anchor' => false, // Needs attribute 'anchor' to be set.
        ];
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
        $atts = self::getBlockHTMLAttributes($block);

        $str = '<div' . Helpers::htmlAtts($atts) . '>';

        $str .= sprintf('<pre>%s</pre>', print_r($attributes, true));

        $str .= '</div>';

        return $str;
    }
}
