<?php // phpcs:ignore PSR1.Files.SideEffects.FoundWithSymbols
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

// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
class NavWalker extends \WP_Bootstrap_Navwalker
{
    protected $mods = [];

    public function __construct()
    {
        add_filter('nav_menu_link_attributes', [$this, 'apply_mods'], 0, 4);
    }

    /**
     * Start the element output.
     *
     * The $args parameter holds additional values that may be used with the child
     * class methods. Includes the element output also.
     *
     * @since 2.1.0
     * @abstract
     *
     * @param string $output            Used to append additional content (passed by reference).
     * @param object $item              The data object.
     * @param int    $depth             Depth of the item.
     * @param array  $args              An array of additional arguments.
     * @param int    $current_object_id ID of the current item.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
        // Get mod classes out of item classes.
        $item_classes = [];
        foreach ($item->classes as $class) {
            if ($this->is_mod($class)) {
                $this->mods[$item->ID][$class] = $class;
            } else {
                $item_classes[] = $class;
            }
        }
        $item->classes = $item_classes;

        // Render element.
        parent::start_el($output, $item, $depth, $args, $current_object_id);
    }

    public function apply_mods($atts, $item, $args, $depth)
    {
        if (!isset($args->walker) || $args->walker !== $this || !isset($this->mods[$item->ID])) {
            return $atts;
        }

        foreach ($this->mods[$item->ID] as $mod) {
            $this->apply_mod($mod, $atts);
        }

        return $atts;
    }

    protected function is_mod($class)
    {
        if (preg_match('/^btn(-|$)/', $class)) {
            return true;
        }

        if (preg_match('/^toggle-/', $class)) {
            return true;
        }

        return false;
    }

    protected function apply_mod($mod, &$atts)
    {
        if (! isset($atts['class'])) {
            $atts['class'] = '';
        }

        if (preg_match('/^btn(-|$)/', $mod)) {
            $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);
            $atts['class'] .= " $mod";
        } elseif (preg_match('/^toggle-(.+)/', $mod, $matches)) {
            list(, $type) = $matches;
            $atts['data-toggle'] = $type;
        }

        ltrim($atts['class']);
    }
}
