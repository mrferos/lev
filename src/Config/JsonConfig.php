<?php
namespace Lev\Config;

class JsonConfig implements ConfigInterface
{
    public function read($file)
    {
        return json_decode(
            file_get_contents($file),
            true
        );
    }

    public function write($file, array $config)
    {
        file_put_contents(
            $file,
            json_encode(
                $config,
                JSON_PRETTY_PRINT
            )
        );
    }

}