<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

final class BasicConfiguration implements Configuration
{
    private $host;
    private $port;
    private $docroot;
    private $router;

    public function __construct($host, $port, $docroot, $router = Configuration::DEFAULT_ROUTER)
    {
        $this->host = $host;
        $this->port = $port;
        $this->docroot = $docroot;
        $this->router = $router;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getDocroot()
    {
        return $this->docroot;
    }

    public function getRouter()
    {
        return $this->router;
    }
}
