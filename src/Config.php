<?php
/**
 * Config
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Config
{
    private static $items = [];

    public static function init()
    {
        self::load();
    }

    public static function get($key)
    {
        if (isset(self::$items[$key])) {
            return self::$items[$key];
        }
        return null;
    }

    public static function set($key, $value = null)
    {
        $items = is_array($key) ? $key : [$key => $value];
        foreach ($items as $key => $value) {
            self::$items[$key] = $value;
        }
    }

    private static function load()
    {
        $theme_file = get_template_directory() . '/config.php';
        self::loadFile($theme_file);

        $child_theme_file = get_stylesheet_directory() . '/config.php';
        if (is_child_theme() && file_exists($child_theme_file) {
            self::loadFile($child_theme_file);
        }
    }

    private static function loadFile($file)
    {
        if (! file_exists($file)) {
            return false;
        }

        ob_start();
        $items = include $file;
        ob_clean();

        if (is_array($items)) {
            self::set($items);
        }

        return true;
    }
}
