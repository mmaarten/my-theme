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

    public static function get($key, $group = 'common')
    {
        if (isset(self::$items[$group]) && isset(self::$items[$group][$key])) {
            return self::$items[$group][$key];
        }
        return null;
    }

    public static function set($key, $value = null, $group = 'common')
    {
        $items = is_array($key) ? $key : [$key => $value];

        foreach ($items as $key => $value) {
            self::$items[$group][$key] = $value;
        }
    }

    private static function load()
    {
        $dir = get_template_directory() . '/config/';
        foreach (new \DirectoryIterator($dir) as $entry) {
            if ('php' === $entry->getExtension()) {
                $file = $entry->getPathname();
                $group = $entry->getBasename('.php');
                self::loadFile($file, $group);
            }
        }
    }

    private static function loadFile($file, $group = 'common')
    {
        if (! file_exists($file)) {
            return false;
        }

        ob_start();
        $config = include $file;
        ob_clean();

        if (isset($config) && is_array($config)) {
            self::set($config, null, $group);
        }
    }
}
