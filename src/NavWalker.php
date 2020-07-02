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

class NavWalker extends \WP_Bootstrap_Navwalker
{
}
