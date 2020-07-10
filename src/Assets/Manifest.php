<?php
/**
 * Assets Manifest
 *
 * @package My/Theme
 */

namespace My\Theme\Assets;

class Manifest
{
    protected $manifest;
    protected $dist;

    public function __construct($filename, $dist_path)
    {
        $this->manifest = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
        $this->dist = $dist_path;
    }

    public function get($asset)
    {
        return isset($this->manifest[$asset]) ? $this->manifest[$asset] : $asset;
    }

    public function getURI($asset)
    {
        return "{$this->dist}/{$this->get($asset)}";
    }
}
