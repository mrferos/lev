<?php
namespace Lev;

use Lev\Executor\ExecutorInterface;

class InstructionSetFactory
{
    /**
     * @var ExecutorInterface
     */
    private $executor;

    public function __construct(ExecutorInterface $executor)
    {
        $this->executor = $executor;
    }

    /**
     * @param array $config
     * @return InstructionSet
     */
    public function fromConfig(array $config)
    {
        return new InstructionSet($config, $this->executor);
    }
}