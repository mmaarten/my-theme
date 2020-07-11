<?php
/**
 * Container
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Container
{
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private $values    = [];
    private $shared    = [];
    private $instances = [];

    public function get($key)
    {
        if (!isset($this->values[$key])) {
            throw new \InvalidArgumentException(sprintf('Value %s has not been set.', $key));
        }

        $value = $this->values[$key];

        if (is_callable($value)) {
            // Check if shared and already instantiated.
            if ($this->shared[$key] && isset($this->instances[$key])) {
                return $this->instances[$key];
            }

            // Create instance.
            $instance = $value($this);

            // Check if shared.
            if ($this->shared[$key]) {
                // Store instance.
                $this->instances[$key] = $instance;
            }

            return $instance;
        }

        return $value;
    }

    public function set($key, $value, $shared = false)
    {
        $this->values[$key] = $value;
        $this->shared[$key] = $shared;
    }
}
