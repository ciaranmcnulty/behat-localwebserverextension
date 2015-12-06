<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

interface Configuration
{
    const DEFAULT_PORT = 8000;
    const DEFAULT_HOST = 'localhost';
    const DEFAULT_DOCROOT = '/web';
    const DEFAULT_ROUTER = null;

    public function getPort();
    public function getHost();
    public function getDocroot();
    public function getRouter();
}

