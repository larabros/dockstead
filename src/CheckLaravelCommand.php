<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckLaravelCommand extends AbstractCommand
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('check:laravel')
            ->setDescription('Check that the current Laravel project is correctly configured for Dockstead');
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
        if (!chmod($this->basePath.'/storage', 777)) {
            $output->writeln('The storage folder is not writeable');
        }

        if (!chmod($this->basePath.'/bootstrap/cache', 777)) {
            $output->writeln('The bootstrap/cache folder is not writeable');
        }

        $output->writeln('Dockstead Installed!');
    }
}
