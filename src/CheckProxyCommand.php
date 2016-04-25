<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckProxyCommand extends AbstractCommand
{
    use ProcessTrait;

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('boot')
            ->setDescription('Check that the Nginx proxy container is running');
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
        $processOutput = $this->runProcess($this->createProcess(['docker', 'ps']));

        if (strpos($processOutput, 'jwilder/nginx-proxy') !== false) {
            $output->writeln('The Nginx proxy is running!');
            return;
        }

        $output->writeln('The Nginx proxy is not running. Run dockstead boot');
        return -1;
    }
}
