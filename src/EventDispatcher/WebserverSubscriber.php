<?php

namespace Cjm\Behat\LocalWebserverExtension\EventDispatcher;

use Behat\Behat\EventDispatcher\Event\StepTested;
use Behat\Testwork\EventDispatcher\Event\ExerciseCompleted;
use Cjm\Behat\LocalWebserverExtension\Webserver\WebserverController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class WebserverSubscriber implements EventSubscriberInterface
{

    /**
     * @var WebserverController
     */
    private $webserverController;

    private $isStarted = false;

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
            StepTested::BEFORE => 'startWebserver',
            ExerciseCompleted::BEFORE_TEARDOWN => 'stopWebserver'
        ];
    }

    public function startWebserver(Foo $foo)
    {

        if (!$this->isStarted) {
            $this->webserverController->startServer();
            $this->isStarted = true;
        }
    }

    public function stopWebserver()
    {
        if ($this->isStarted) {
            $this->webserverController->stopServer();
        }
    }
}