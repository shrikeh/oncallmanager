<?php
namespace App\Provider;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameWithoutSuffixInflector;
use League\Tactician\Plugins\NamedCommand\NamedCommandExtractor;
use Pimple\Container;

/**
 * Class CommandBusServiceProvider
 * @package App\Provider
 */
final class CommandBusServiceProvider
{
    const COMMAND_BUS           = 'command_bus';
    const TACTICIAN_INFLECTOR   = self::COMMAND_BUS.'tactician.inflector';
    const TACTICIAN_MIDDLEWARE  = self::COMMAND_BUS.'tactician.middleware';
    const TACTICIAN_EXTRACTOR   = self::COMMAND_BUS.'tactician.extractor';
    const TACTICIAN_LOCATOR     = self::COMMAND_BUS.'tactician.locator';

    public function register(Container $container)
    {
        $container[self::TACTICIAN_EXTRACTOR] = function(Container $con) {
            return new NamedCommandExtractor();
        };

        $container[self::TACTICIAN_LOCATOR] = function(Container $con) {
            return new NamedCommandExtractor();
        };

        $container[self::TACTICIAN_INFLECTOR] = function(Container $con) {
            return new HandleClassNameWithoutSuffixInflector();
        };

        $container[self::TACTICIAN_MIDDLEWARE] = function(Container $con) {
            return new CommandHandlerMiddleware(
                $con[self::TACTICIAN_EXTRACTOR],
                $con[self::TACTICIAN_LOCATOR],
                $con[self::TACTICIAN_INFLECTOR]
            );
        };

        $container[self::COMMAND_BUS] = function(Container $con) {
            return new CommandBus(
                $con[self::TACTICIAN_MIDDLEWARE]
            );
        };
    }
}
