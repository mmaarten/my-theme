<?php
/**
 * Main application
 *
 * @package My/Theme
 */

namespace My\Theme;

final class App
{
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected $did_init = false;

    private function __construct()
    {
    }

    /**
     * Initialize
     */
    public function init()
    {
        if ($this->did_init) {
            return;
        }

        $this->did_init = true;

        Setup::init();
        Assets::init();
        Navs::init();
        Widgets::init();
        Customizer::init();
        Editor::init();

        require get_template_directory() . '/inc/template-functions.php';
        require get_template_directory() . '/inc/template-tags.php';
    }
}
