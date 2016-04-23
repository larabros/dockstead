<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends Command
{
    /**
     * The base path of the project.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The path to the ``docker-compose.yml`` file.
     *
     * @var string
     */
    protected $dockerComposePath;

    /**
     * The name of the project folder.
     *
     * @var string
     */
    protected $projectName;

    /**
     * Sluggified Project Name.
     *
     * @var string
     */
    protected $defaultName;

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->basePath          = getcwd();
        $this->dockerComposePath = $this->basePath . '/docker-compose.yml';
        $this->projectName       = basename(getcwd());
        $this->defaultName       = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->projectName)));

        $this->setName('make')
            ->setDescription('Install Dockstead into the current project');
    }

    /**
     * Execute the command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        // If ``docker-compose.yml`` does not exist
        if (! file_exists($this->dockerComposePath) {
            copy(__DIR__.'/stubs/docker-compose.yml', $this->dockerComposePath);
        }

        $output->writeln('Dockstead Installed!');
    }
}
