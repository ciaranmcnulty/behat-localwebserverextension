<?php

namespace Cjm\Behat\LocalWebserverExtension\Webserver;

interface Configuration
{
    public function getPort();

    public function getHost();
}