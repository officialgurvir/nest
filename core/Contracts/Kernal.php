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

    public static function handle(string $path)
    {
        $SERVER_CLONE = $_SERVER;
        self::getEnvironmentVariables($path);

        $_ENV['__DIR__'] = $path;
        $_SERVER = $SERVER_CLONE;

        return Application::make($_ENV);
    }
}
