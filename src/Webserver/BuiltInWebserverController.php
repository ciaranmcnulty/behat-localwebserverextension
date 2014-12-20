<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Process\Process;

final class BuiltInWebserverController implements WebserverController
{
    /**
     * @var Process
     */
    private $process;

    public function startServer()
    {
        $command = $this->getCommand();
        $this->process = new Process($command);
        $this->process->setWorkingDirectory(__DIR__ . '/../../web/');
        $this->process->start();

        $start = microtime(true);
        while (!$this->isStarted()) {
            if ((microtime(true) - $start) < 5) {
                sleep(0.1);
                continue;
            }
            throw new \RuntimeException('Webserver did not start within 5 seconds');
        }

    }

    public function isStarted()
    {
        if(!$this->process->isStarted() || !$this->process->getOutput()) {
            return false;
        }

        if (!strpos($output = $this->process->getOutput(), 'started')) {
            throw new \RuntimeException("Problem starting webserver:\n$output");
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
        if (strpos(`man script`, 'BSD General Commands Manual ')) {
            return 'script -q /dev/stdout php -S localhost:8000';
        }

        throw new \RuntimeException('Unable to start server on this platform (Supported: OSX/BSD)');
    }
}