<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

final class BasicConfiguration implements Configuration
{
    const DEFAULT_PORT = 8000;
    const DEFAULT_HOST = 'localhost';

    private $host;
    private $port;

    public function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function getPort()
    {
        return $this->port ?: self::DEFAULT_PORT;
    }

    public function getHost()
    {
        return $this->host ?: self::DEFAULT_HOST;
    }
}
