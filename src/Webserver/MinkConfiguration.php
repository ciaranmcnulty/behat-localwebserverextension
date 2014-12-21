<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

final class MinkConfiguration implements Configuration
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
    /**
     * @var
     */
    private $docroot;

    public function __construct($host, $port, $docroot, $baseUrl)
    {
        $this->host = $host;
        $this->port = $port;
        $this->docroot = $docroot;
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

    public function getDocroot()
    {
        return $this->docroot;
    }
}
