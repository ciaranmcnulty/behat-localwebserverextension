<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

final class BuiltInWebserverController implements WebserverController
{
    /**
     * @var Process
     */
    private $process;

    /**
     * @var BasicConfiguration
     */
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function startServer()
    {
        $command = $this->getCommand();

        $this->process = new Process($command);
        $this->process->start();

        $start = microtime(true);
        while (!$this->isStarted()) {
            if ((microtime(true) - $start) < 5) {
                sleep(0.1);
                continue;
            }
            throw new \RuntimeException('Webserver did not start within 5 seconds: '. $this->process->getErrorOutput());
        }

    }

    public function isStarted()
    {
        if(!$this->process->isStarted()) {
            return false;
        }

        if(!@fsockopen($this->config->getHost(), $this->config->getPort())) {
            return false;
        }

        return true;
    }

    public function stopServer()
    {
        $this->process->stop();
    }

    /**
     * @return string
     */
    private function getCommand()
    {
        $phpFinder = new PhpExecutableFinder();
        return sprintf(
             'exec %s -S %s -t %s',
             escapeshellcmd($phpFinder->find()),
             escapeshellarg($this->config->getHost() . ':' . $this->config->getPort()),
             escapeshellarg($this->config->getDocroot())
        );
    }
}
