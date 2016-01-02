<?php
namespace Lev\Config;

interface ConfigInterface
{
    /**
     * Read a configuration file and transform into array
     *
     * @param $file
     * @return array
     */
    public function read($file);

    /**
     * Write configuration array to file
     *
     * @param $file
     * @param array $config
     * @return void
     */
    public function write($file, array $config);
}