<?php

namespace spec\Cjm\Behat\LocalWebserverExtension\Suite;

use Behat\Testwork\Suite\Suite;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuiteIdentifierSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            ['webserversuite']
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Cjm\Behat\LocalWebserverExtension\Suite\SuiteIdentifier');
    }

    function it_knows_if_a_suite_needs_a_webserver(Suite $suite)
    {
        $suite->getName()->willReturn('webserversuite');
        $this->suiteNeedsWebserver($suite)->shouldReturn(true);
    }

    function it_knows_if_a_suite_does_not_need_a(Suite $suite)
    {
        $suite->getName()->willReturn('domainsuite');
        $this->suiteNeedsWebserver($suite)->shouldReturn(false);
    }

    function it_says_a_server_is_needed_when_nothing_was_specified(Suite $suite)
    {
        $this->beConstructedWith([]);

        $suite->getName()->willReturn('domainsuite');
        $this->suiteNeedsWebserver($suite)->shouldReturn(true);
    }
}

