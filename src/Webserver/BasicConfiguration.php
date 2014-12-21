<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

final class BasicConfiguration implements Configuration
{
    private $host;
    private $port;
    private $docroot;

    public function __construct($host, $port, $docroot)
    {
        $this->host = $host;
        $this->port = $port;
        $this->docroot = $docroot;
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
}
