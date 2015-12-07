<?php

namespace spec\Cjm\Behat\LocalWebserverExtension\Webserver;

use Cjm\Behat\LocalWebserverExtension\Webserver\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasicConfigurationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(null, null, null, null, null, null);
    }

    function it_is_a_webserver_configuration()
    {
        $this->shouldHaveType('Cjm\Behat\LocalWebserverExtension\Webserver\Configuration');
    }

    function it_defaults_the_port_to_null()
    {
        $this->getPort()->shouldBeNull();
    }

    function it_defaults_the_host_to_null()
    {
        $this->getHost()->shouldBeNull();
    }

    function it_defaults_the_docroot_to_null()
    {
        $this->getDocroot()->shouldBeNull();
    }

    function it_defaults_the_router_to_null()
    {
        $this->getRouter()->shouldBeNull();
    }

    function it_uses_the_host_it_is_constructed_with()
    {
        $this->beConstructedWith('192.168.0.1', null, null, null);
        $this->getHost()->shouldReturn('192.168.0.1');
    }

    function it_uses_the_port_it_is_constructed_with()
    {
        $this->beConstructedWith(null, 80, null, null);
        $this->getPort()->shouldReturn(80);
    }

    function it_uses_the_docroot_it_is_constructed_with()
    {
        $this->beConstructedWith(null, null, '/var/www', null);
        $this->getDocroot()->shouldReturn('/var/www');
    }

    function it_uses_the_router_it_is_constructed_with()
    {
        $this->beConstructedWith(null, null, null, 'router.php');
        $this->getRouter()->shouldReturn('router.php');
    }
}

