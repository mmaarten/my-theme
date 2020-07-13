<?php
/**
 * Config
 *
 * @package My/Theme
 */

namespace My\Theme;

class Config
{
    protected $items = [];

    public function __construct($items = [])
    {
        $this->set($items);
    }

    public function get($key = null)
    {
        if (is_null($key)) {
            return $this->items;
        }

        $path = explode('.', $key);

        $items = $this->items;

        foreach ($path as $key) {
            if (isset($items[$key])) {
                $items = &$items[$key];
            } else {
                return null;
            }
        }

        return $items;
    }

    public function set($key, $value = null)
    {
        $items = is_array($key) ? $key : [$key => $value];

        foreach ($items as $key => $value) {
            $this->items[$key] = $value;
        }
    }
}
