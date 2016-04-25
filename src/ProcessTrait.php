<?php

namespace Larabros\Dockstead;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

trait ProcessTrait
{
    /**
     * Builds a ``Process``.
     *
     * @param array $process
     *
     * @return Process
     */
    protected function createProcess(array $process)
    {
        return (new ProcessBuilder($process))->getProcess();
    }

    /**
     * Runs a ``Process``.
     *
     * @param Process $process
     *
     * @return string
     * 
     * @throws ProcessFailedException
     */
    protected function runProcess(Process $process)
    {
        try {
            $process->mustRun();
            $message = $process->getOutput();
        } catch (ProcessFailedException $e) {
            $message = '<error>'.$e->getMessage().'</error>';
        }

        return $message;
    }
}