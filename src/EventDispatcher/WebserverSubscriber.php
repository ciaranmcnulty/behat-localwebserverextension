<?php

namespace Cjm\Behat\LocalWebserverExtension\EventDispatcher;

use Behat\Testwork\EventDispatcher\Event\SuiteTested;
use Cjm\Behat\LocalWebserverExtension\Webserver\WebserverController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class WebserverSubscriber implements EventSubscriberInterface
{

    /**
     * @var WebserverController
     */
    private $webserverController;

    /**
     * @param WebserverController $webserverController
     */
    public function __construct(WebserverController $webserverController)
    {
        $this->webserverController = $webserverController;
    }

    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            SuiteTested::BEFORE => 'startWebserver',
            SuiteTested::AFTER => 'stopWebserver'
        ];
    }

    public function startWebserver()
    {
        $this->webserverController->startServer();
    }

    public function stopWebserver()
    {
        $this->webserverController->stopServer();
    }
}