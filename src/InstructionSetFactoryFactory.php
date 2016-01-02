<?php
namespace Lev;

use Lev\Executor\ExecutorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InstructionSetFactoryFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return InstructionSetFactory
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new InstructionSetFactory($serviceLocator->get(ExecutorInterface::class));
    }
}