<?php
namespace Lev\Executor;

use Lev\InstructionSet;
use Zend\EventManager\EventManagerInterface;

class BashExecutor implements ExecutorInterface
{
    /**
     * @var EventManagerInterface
     */
    private $eventManager;
    private $bashSource;

    /**
     * BashExecutor constructor.
     * @param EventManagerInterface $eventManager
     */
    public function __construct(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function execute(InstructionSet $instructionSet)
    {
        $this->bashSource = '';
        $this->installPackages($instructionSet->getPackages());
        file_put_contents(getcwd() . '/install.sh', $this->bashSource);
    }

    /**
     * @param InstructionSet\Package[] $packages
     */
    protected function installPackages(array $packages)
    {
        foreach ($packages as $package) {
            $installSteps = $package->getInstallSteps();
            if (empty($installSteps)) {
                $name = $package->getName();
                $source = $package->getSource();
                if (!empty($source)) {
                    $this->writef("add-apt-repository %s -y\n", $source);
                }

                $version = $package->getVersion();
                if (!empty($version)) {
                    $this->write("apt-get install %s=%s\n", $name, $version);
                } else {
                    $this->write("apt-get install %s\n", $name);
                }
            } else {
                foreach ($installSteps as $installStep) {
                    $this->write($installStep);
                }
            }
        }
    }

    protected function write($message, ...$args)
    {
        $this->bashSource .= vsprintf($message, $args);
    }
}