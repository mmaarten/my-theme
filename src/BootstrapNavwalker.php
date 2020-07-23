<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols
// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
/**
 * Nav Walker
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Include WP_Bootstrap_Navwalker.
 * @link https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 */
require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

class BootstrapNavwalker extends \WP_Bootstrap_Navwalker
{
    protected $mods = [];

    public function __construct()
    {
        add_filter('nav_menu_link_attributes', [$this, 'link_attributes'], PHP_INT_MAX, 4);
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_classes = [];
        foreach ($item->classes as $class) {
            if (preg_match('/^btn-/', $class)) {
                $this->mods[$item->ID]['btn'][$class] = $class;
            } else {
                $item_classes[] = $class;
            }
        }
        $item->classes = $item_classes;

        parent::start_el($output, $item, $depth, $args, $id);
    }

    public function link_attributes($atts, $item, $nav_menu, $depth)
    {
        $mods = isset($this->mods[$item->ID]) ? $this->mods[$item->ID] : [];

        if (! empty($mods['btn'])) {
            $btn_classes = $mods['btn'];

            // Make sure 'btn' class is added

            $btn_classes = ['btn' => 'btn'] + $btn_classes;

            // Make sure 'class' attribute is set.

            if (! isset($atts['class'])) {
                $atts['class'] = '';
            }

            // Remove 'nav-link' class

            $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);

            // Add button attributes

            $atts['class'] .= ' ' . implode(' ', $btn_classes);

            $atts['role'] = 'button';

            // Sanitize 'class' attribute.

            $atts['class'] = trim($atts['class']);
        }

        return $atts;
    }
}
