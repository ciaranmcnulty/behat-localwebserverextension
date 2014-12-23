<?php

namespace Cjm\Behat\LocalWebserverExtension\Suite;

use Behat\Testwork\Suite\Suite;

class SuiteIdentifier
{

    /**
     * @var array
     */
    private $suiteNames;

    public function __construct(array $suiteNames)
    {
        $this->suiteNames = $suiteNames;
    }

    public function suiteNeedsWebserver(Suite $suite)
    {
        if (!count($this->suiteNames)) {
            return true;
        }

        return in_array($suite->getName(), $this->suiteNames);
    }
}
