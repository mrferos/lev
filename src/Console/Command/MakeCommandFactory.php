<?php
namespace Lev\Console\Command;

use Lev\Config\ConfigInterface;
use Lev\Executor\ExecutorInterface;
use Lev\InstructionSetFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MakeCommandFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new MakeCommand(
            null,
            $serviceLocator->get(ConfigInterface::class),
            $serviceLocator->get(InstructionSetFactory::class),
            $serviceLocator->get(ExecutorInterface::class)
        );
    }
}