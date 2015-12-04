<?php

namespace Cjm\Behat\LocalWebserverExtension\EventDispatcher;

use Behat\Behat\EventDispatcher\Event\BeforeStepTested;
use Behat\Testwork\EventDispatcher\Event\BeforeSuiteTested;
use Behat\Testwork\EventDispatcher\Event\ExerciseCompleted;
use Behat\Testwork\EventDispatcher\Event\SuiteTested;
use Cjm\Behat\LocalWebserverExtension\Suite\SuiteIdentifier;
use Cjm\Behat\LocalWebserverExtension\Webserver\WebserverController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class WebserverSubscriber implements EventSubscriberInterface
{

    /**
     * @var WebserverController
     */
    private $webserverController;

    private $isStarted = false;

    public function __construct(WebserverController $webserverController, SuiteIdentifier $suiteIdentifier)
    {
        $this->webserverController = $webserverController;
        $this->suiteIdentifier = $suiteIdentifier;
    }

    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            SuiteTested::BEFORE => 'startWebserver',
            ExerciseCompleted::BEFORE_TEARDOWN => 'stopWebserver'
        ];
    }

    public function startWebserver(BeforeSuiteTested $suiteEvent)
    {
        $suite = $suiteEvent->getSuite();

        if ($this->suiteIdentifier->suiteNeedsWebserver($suite) && !$this->isStarted) {
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

