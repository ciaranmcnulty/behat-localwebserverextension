<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

class MinkConfiguration implements Configuration
{
    /**
     * @var
     */
    private $host;
    /**
     * @var
     */
    private $port;
    /**
     * @var
     */
    private $baseUrl;

    public function __construct($host, $port, $baseUrl)
    {
        $this->host = $host;
        $this->port = $port;
        $this->baseUrl = $baseUrl;
    }

    public function getPort()
    {
        return $this->port ?: parse_url($this->baseUrl, PHP_URL_PORT);
    }

    public function getHost()
    {
        return $this->host ?: parse_url($this->baseUrl, PHP_URL_HOST);
    }
}
