<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

class BootCommand extends AbstractCommand
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
            ->setDescription('Starts the nginx proxy');
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
        $returnCode = $this->getApplication()->find('check:proxy')->run([], new NullOutput());

        if ($returnCode === false) {
            $process = 'docker run -d -p 80:80 -v /var/run/docker.sock:/tmp/docker.sock:ro jwilder/nginx-proxy';
            $output->writeln($this->runProcess($this->createProcess(explode(' ', $process))));
        }

        $output->writeln('The host system is correctly set up!');
        return;
    }
}
