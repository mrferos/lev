<?php
namespace Lev\InstructionSet;

class Package
{
    /**
     * The repository where the package can be found
     *
     * @var string
     */
    protected $source;

    /**
     * The steps to install the package
     *
     * @var array
     */
    protected $installSteps;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $version;

    /**
     * @param array|string $packageData
     * @return static
     */
    public static function factory($name, $packageData)
    {
        if (is_string($packageData)) {
            $packageData = ['version' => $packageData];
        } elseif (!is_array($packageData)) {
            throw new \RuntimeException("Package Data was incorrectly formatted");
        }

        $package = new static();
        $package->setVersion($packageData['version']);
        $package->setName($name);
        $package->setSource(
            isset($packageData['source']) ? $packageData['source'] : null
        );

        return $package;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return array
     */
    public function getInstallSteps()
    {
        return $this->installSteps;
    }

    /**
     * @param array $installSteps
     */
    public function setInstallSteps(array $installSteps)
    {
        $this->installSteps = $installSteps;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}