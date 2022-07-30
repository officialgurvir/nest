<?php

namespace Framework\Contracts;

use Dotenv\Dotenv;
use Framework\Foundation\Application;

class Kernal
{
    private static function getEnvironmentVariables(string $path)
    {
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
    }

    public static function create(string $path, array $argv) {
        if (!isset($argv[1]))
            $argv[1] = 'help';

        self::getEnvironmentVariables($path);
        return new CommandLineInterface($argv[1]);
    }

    public static function handle(string $path)
    {
        $SERVER_CLONE = $_SERVER;
        self::getEnvironmentVariables($path);

        define('APPLICATION_DIRECTORY', $path);
        $_SERVER = $SERVER_CLONE;

        return Application::make($_ENV);
    }
}
