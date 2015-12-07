<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

final class DefaultConfiguration implements Configuration
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var
     */
    private $basePath;

    public function __construct(Configuration $configuration, $basePath)
    {
        $this->configuration = $configuration;
        $this->basePath = $basePath;
    }

    public function getPort()
    {
        return $this->configuration->getPort() ?: Configuration::DEFAULT_PORT;
    }

    public function getHost()
    {
        return $this->configuration->getHost() ?: Configuration::DEFAULT_HOST;
    }

    public function getDocroot()
    {
        return $this->configuration->getDocroot() ?: $this->basePath . Configuration::DEFAULT_DOCROOT;
    }

    public function getRouter()
    {
        return $this->configuration->getRouter() ?: Configuration::DEFAULT_ROUTER;
    }
}

