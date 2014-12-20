<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

interface WebserverController
{
    public function startServer();

    public function stopServer();

    /**
     * @return boolean
     */
    public function isStarted();
} 