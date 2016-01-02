<?php
namespace Lev;

use Lev\Executor\ExecutorInterface;
use Lev\InstructionSet\Package;

class InstructionSet
{
    /**
     * raw instruction configurations
     *
     * @var array
     */
    private $config;

    /**
     * @var Package[]
     */
    private $packages = [];

    public function __construct(array $config)
    {

        $this->config = $config;

        $this->walkPackages($config);
    }

    /**
     * @return InstructionSet\Package[]
     */
    public function getPackages()
    {
        return $this->packages;
    }


    /**
     * Find packages in passed configuration
     *
     * @param array $config
     */
    protected function walkPackages(array $config)
    {
        if (!array_key_exists('packages', $config)) {
            return;
        }

        foreach ($config['packages'] as $name => $packageConfig)
        {
            $package = Package::factory($name, $packageConfig);
            $packageName = $package->getName();
            if (isset($this->packages[$packageName])) {
                throw new \RuntimeException(
                    "Package name conflict: " . $packageName
                );
            }

            $this->packages[$packageName] = $package;
        }
    }
}