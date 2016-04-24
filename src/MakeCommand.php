<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Command\Command;
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
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        // If ``docker-compose.yml`` does not exist
        if (! file_exists($this->dockerComposePath)) {
            copy(__DIR__.'/stubs/docker-compose.yml', $this->dockerComposePath);
        }

        // If ``docker`` folder does not exist
        $dockerPath = $this->basePath.'/docker';
        if (! file_exists($dockerPath)) {
            mkdir($dockerPath);
        }

        // If ``docker/nginx`` folder does not exist
        if (! file_exists($dockerPath.'/nginx')) {
            mkdir($dockerPath.'/nginx');
            copy(__DIR__.'/stubs/nginx/default.conf', $dockerPath.'/nginx/default.conf');
            copy(__DIR__.'/stubs/nginx/Dockerfile', $dockerPath.'/nginx/Dockerfile');
        }

        // If ``docker/php`` folder does not exist
        if (! file_exists($dockerPath.'/php')) {
            mkdir($dockerPath.'/php');
            copy(__DIR__.'/stubs/php/Dockerfile', $dockerPath.'/php/Dockerfile');
        }

        $output->writeln('Dockstead Installed!');
    }
}
