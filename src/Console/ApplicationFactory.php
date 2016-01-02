<?php
namespace Lev\Console;

use Symfony\Component\Console\Application;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApplicationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $application = new Application($config['console']['name'], $config['console']['version']);
        foreach (glob(__DIR__ . '/Command/*Command.php') as $commandFile) {
            $className = __NAMESPACE__ . '\\Command\\' . rtrim(basename($commandFile), '.php');
            $application->add($serviceLocator->get($className));
        }

        return $application;
    }
}