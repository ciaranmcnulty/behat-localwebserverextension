<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements SnippetAcceptingContext
{
    private $content;

    /**
     * @When my context connects to the local webserver
     */
    public function myContextConnectsToTheLocalWebserver()
    {
        $this->content = file_get_contents('http://localhost:8000');
    }

    /**
     * @Then I should receive some content
     */
    public function iShouldReceiveSomeContent()
    {
        if (!$this->content) {
            throw new Exception('Received no response from local server');
        }
    }
}
