<?php

namespace spec\Cjm\Behat\LocalWebserverExtension\Webserver;

use Cjm\Behat\LocalWebserverExtension\Webserver\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    function it_defaults_the_port()
    {
        $this->beConstructedWith(null, null);
        $this->getPort()->shouldReturn(Configuration::DEFAULT_PORT);
    }

    function it_defaults_the_host()
    {
        $this->beConstructedWith(null, null);
        $this->getHost()->shouldReturn(Configuration::DEFAULT_HOST);
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
