<?php

namespace spec\Cjm\Behat\LocalWebserverExtension\Webserver;

use Cjm\Behat\LocalWebserverExtension\Webserver\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MinkConfigurationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(null, null, 'http://dev.local:9001/foo/bar');
    }

    function it_is_a_webserver_configuration()
    {
        $this->shouldHaveType('Cjm\Behat\LocalWebserverExtension\Webserver\Configuration');
    }

    function it_gets_the_host_from_the_baseurl()
    {
        $this->getHost()->shouldReturn('dev.local');
    }

    function it_gets_the_port_from_the_baseurl()
    {
        $this->getPort()->shouldReturn(9001);
    }

    function it_uses_the_host_from_configuration_when_one_is_provided()
    {
        $this->beConstructedWith('localhost', null, 'http://dev.local:9001/foo/bar');
        $this->getHost()->shouldReturn('localhost');
    }

    function it_uses_the_port_from_configuration_when_one_is_provided()
    {
        $this->beConstructedWith(null, 9000, 'http://dev.local:9001/foo/bar');
        $this->getPort()->shouldReturn(9000);
    }
}
