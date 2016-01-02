<?php

use Lev\Config\ConfigInterface;
use Lev\Config\JsonConfig;
use Lev\Console\ApplicationFactory;
use Lev\Console\Command\MakeCommand;
use Lev\Console\Command\MakeCommandFactory;
use Lev\Executor\BashExecutorFactory;
use Lev\Executor\ExecutorInterface;
use Lev\InstructionSetFactory;
use Lev\InstructionSetFactoryFactory;

return [
    'dependencies' => [
        'factories' => [
            'application' => ApplicationFactory::class,
            MakeCommand::class => MakeCommandFactory::class,
            InstructionSetFactory::class => InstructionSetFactoryFactory::class,
            ExecutorInterface::class => BashExecutorFactory::class
        ],
        'invokables' => [
            ConfigInterface::class => JsonConfig::class,
        ]
    ]
];
