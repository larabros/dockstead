<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Command\Command;

abstract class AbstractCommand extends Command
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
    }
}
