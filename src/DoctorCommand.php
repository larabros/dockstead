<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoctorCommand extends AbstractCommand
{
    use ProcessTrait;

    protected $processes = [
        ['docker', 'version'],
        ['docker-compose', 'version'],
    ];

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('doctor')
            ->setDescription('Check that the host system is correctly set up');
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
        foreach ($this->processes as $process) {
            $this->runProcess($this->createProcess($process), $output);
        }

        $output->writeln('The host system is correctly set up!');
    }
}
