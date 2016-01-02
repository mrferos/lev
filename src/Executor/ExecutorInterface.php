<?php
namespace Lev\Executor;

use Lev\InstructionSet;

interface ExecutorInterface
{
    public function execute(InstructionSet $instructionSet);
}