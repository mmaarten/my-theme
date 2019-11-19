<?php

namespace My\Theme;

class Container extends \League\Container\Container
{
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        parent::__construct();

        if (!is_null(self::$instance)) {
            throw new Exception('Only 1 instance allowed.');
        }

        self::$instance = $this;
    }
}
