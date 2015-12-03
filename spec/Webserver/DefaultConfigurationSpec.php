<?php

namespace spec\Cjm\Behat\LocalWebserverExtension\Webserver;

use Cjm\Behat\LocalWebserverExtension\Webserver\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultConfigurationSpec extends ObjectBehavior
{
    function let(Configuration $configuration)
    {
        $this->beConstructedWith($configuration, '/var/www/myproject');
    }

    function it_is_a_webserver_configuration()
    {
        $this->shouldHaveType('Cjm\Behat\LocalWebserverExtension\Webserver\Configuration');
    }

    function it_defaults_the_hostname()
    {
        $this->getHost()->shouldReturn(Configuration::DEFAULT_HOST);
    }

    function it_uses_inner_hostname_where_there_is_one(Configuration $configuration)
    {
        $configuration->getHost()->willReturn('dev.local');
        $this->getHost()->shouldReturn('dev.local');
    }

    function it_defaults_the_port()
    {
        $this->getPort()->shouldReturn(Configuration::DEFAULT_PORT);
    }

    function it_uses_inner_port_where_there_is_one(Configuration $configuration)
    {
        $configuration->getPort()->willReturn(9090);
        $this->getPort()->shouldReturn(9090);
    }

    function it_defaults_the_docroot()
    {
        $this->getDocroot()->shouldReturn('/var/www/myproject' . Configuration::DEFAULT_DOCROOT);
    }

    function it_uses_inner_docroot_where_there_is_one(Configuration $configuration)
    {
        $configuration->getDocroot()->willReturn('/home/user/www');
        $this->getDocroot()->shouldReturn('/home/user/www');
    }

    function it_defaults_the_router()
    {
        $this->getRouter()->shouldReturn(Configuration::DEFAULT_ROUTER);
    }

    function it_uses_inner_router_where_there_is_one(Configuration $configuration)
    {
        $configuration->getRouter()->willReturn('router.php');
        $this->getRouter()->shouldReturn('router.php');
    }
}
