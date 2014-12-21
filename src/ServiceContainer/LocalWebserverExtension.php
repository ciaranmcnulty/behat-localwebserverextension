<?php

namespace Cjm\Behat\LocalWebserverExtension\ServiceContainer;

use Behat\Testwork\EventDispatcher\ServiceContainer\EventDispatcherExtension;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class LocalWebserverExtension implements Extension
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasParameter('mink.base_url')) {
            $definition = new Definition('Cjm\Behat\LocalWebserverExtension\Webserver\MinkConfiguration', array(
                '%cjm.local_webserver.configuration.host%',
                '%cjm.local_webserver.configuration.port%',
                '%cjm.local_webserver.configuration.docroot%',
                '%mink.base_url%'
            ));
            $container->setDefinition('cjm.local_webserver.configuration.mink', $definition);

            $container->setAlias('cjm.local_webserver.configuration.inner', new Alias('cjm.local_webserver.configuration.mink'));
        }
        else {
            $container->setAlias('cjm.local_webserver.configuration.inner', new Alias('cjm.local_webserver.configuration.basic'));
        }
    }

    /**
     * Returns the extension config key.
     *
     * @return string
     */
    public function getConfigKey()
    {
        return 'localwebserver';
    }

    /**
     * Initializes other extensions.
     *
     * This method is called immediately after all extensions are activated but
     * before any extension `configure()` method is called. This allows extensions
     * to hook into the configuration of other extensions providing such an
     * extension point.
     *
     * @param ExtensionManager $extensionManager
     */
    public function initialize(ExtensionManager $extensionManager)
    {
    }

    /**
     * Setups configuration for the extension.
     *
     * @param ArrayNodeDefinition $builder
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('host')
                    ->defaultNull()
                ->end()
                ->scalarNode('port')
                    ->defaultNull()
                ->end()
                ->scalarNode('docroot')
                    ->defaultNull()
                ->end()
            ->end()
        ->end();
    }

    /**
     * Loads extension services into temporary container.
     *
     * @param ContainerBuilder $container
     * @param array $config
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $container->setParameter('cjm.local_webserver.configuration.host', $config['host']);
        $container->setParameter('cjm.local_webserver.configuration.port', $config['port']);
        $container->setParameter('cjm.local_webserver.configuration.docroot', $config['docroot']);

        $this->loadEventSubscribers($container);
        $this->loadWebserverController($container);
        $this->loadWebserverConfiguration($container, $config);
    }

    private function loadEventSubscribers(ContainerBuilder $container)
    {
        $definition = new Definition('Cjm\Behat\LocalWebserverExtension\EventDispatcher\SuiteSubscriber', array(
            new Reference('cjm.local_webserver.webserver_controller.built_in')
        ));
        $definition->addTag(EventDispatcherExtension::SUBSCRIBER_TAG);
        $container->setDefinition('cjm.local_webserver.suite_listener', $definition);
    }

    private function loadWebserverController(ContainerBuilder $container)
    {
        $definition = new Definition('Cjm\Behat\LocalWebserverExtension\Webserver\BuiltInWebserverController', array(
            new Reference('cjm.local_webserver.configuration')
        ));
        $container->setDefinition('cjm.local_webserver.webserver_controller.built_in', $definition);
    }

    private function loadWebserverConfiguration(ContainerBuilder $container)
    {
        $definition = new Definition('Cjm\Behat\LocalWebserverExtension\Webserver\BasicConfiguration', array(
            '%cjm.local_webserver.configuration.host%',
            '%cjm.local_webserver.configuration.port%',
            '%cjm.local_webserver.configuration.docroot%'
        ));
        $container->setDefinition('cjm.local_webserver.configuration.basic', $definition);

        $definition = new Definition('Cjm\Behat\LocalWebserverExtension\Webserver\DefaultConfiguration', array(
            new Reference('cjm.local_webserver.configuration.inner'),
            '%paths.base%'
        ));
        $container->setDefinition('cjm.local_webserver.configuration', $definition);
    }
}
