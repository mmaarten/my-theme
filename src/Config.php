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
        $file = locate_template('config.php');

        if (! $file) {
            return;
        }

        include $file;

        if (isset($config) && is_array($config)) {
            self::set($config);
        }
    }
}
