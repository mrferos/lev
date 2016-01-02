<?php
namespace Lev\Console\Command;

use Lev\Config\ConfigInterface;
use Lev\Executor\ExecutorInterface;
use Lev\InstructionSetFactory;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends SymfonyCommand
{
    /**
     * @var ConfigInterface
     */
    private $configIo;
    /**
     * @var InstructionSetFactory
     */
    private $instructionSetFactory;
    /**
     * @var ExecutorInterface
     */
    private $executor;

    public function __construct(
        $name,
        ConfigInterface $configIo,
        InstructionSetFactory $instructionSetFactory,
        ExecutorInterface $executor
    ) {
        parent::__construct($name);

        $this->configIo              = $configIo;
        $this->instructionSetFactory = $instructionSetFactory;
        $this->executor              = $executor;
    }

    protected function configure()
    {
        $this->setName('make');
        $this->addOption('config-file', 'c', InputOption::VALUE_OPTIONAL, 'Configuration File');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configFile = $input->getOption('config-file') ?: getcwd() . '/package.json';
        if (!file_exists($configFile)) {
            $output->writeln(sprintf('<error>Could not find config file "%s"</error>', $configFile));
            return 1;
        }

        $config = $this->configIo->read($configFile);
        $instructionSet = $this->instructionSetFactory->fromConfig($config);
        $this->executor->execute($instructionSet);
    }
}