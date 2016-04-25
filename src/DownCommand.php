<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DownCommand extends AbstractCommand
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('down')
            ->setDescription('Stop and remove the Docker containers for the current project');
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface   $input
     * @param  OutputInterface  $output
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('docker-compose down');

        try {
            $process->mustRun();
            $output->writeln($process->getErrorOutput());
        } catch (ProcessFailedException $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return;
        }

        $output->writeln('Docker environment destroyed!');
    }
}
