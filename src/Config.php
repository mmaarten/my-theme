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

    /**
     * Constructor
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $this->set($items);
    }

    /**
     * Get config item(s).
     *
     * @param null|string $key
     * @return mixed
     */
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

    /**
     * Add config item(s).
     *
     * @param string|array $key
     * @param null\mixed $value
     */
    public function set($key, $value = null)
    {
        $items = is_array($key) ? $key : [$key => $value];

        foreach ($items as $key => $value) {
            $this->items[$key] = $value;
        }
    }
}
