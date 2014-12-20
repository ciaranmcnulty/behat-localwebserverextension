<?php

namespace spec\Cjm\Behat\LocalWebserverExtension\Webserver;

use Cjm\Behat\LocalWebserverExtension\Webserver\BasicConfiguration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasicConfigurationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(null, null);
    }

    function it_is_a_webserver_configuration()
    {
        $this->shouldHaveType('Cjm\Behat\LocalWebserverExtension\Webserver\Configuration');
    }

    function it_defaults_the_port()
    {
        $this->getPort()->shouldReturn(BasicConfiguration::DEFAULT_PORT);
    }

    function it_defaults_the_host()
    {
        $this->getHost()->shouldReturn(BasicConfiguration::DEFAULT_HOST);
    }

    function it_uses_the_host_it_is_constructed_with()
    {
        $this->beConstructedWith('192.168.0.1', null);
        $this->getHost()->shouldReturn('192.168.0.1');
    }

    function it_uses_the_port_it_is_constructed_with()
    {
        $this->beConstructedWith(null, 80);
        $this->getPort()->shouldReturn(80);
    }
}
