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
        self::getEnvironmentVariables($path);

        $_ENV['__DIR__'] = $path;

        return Application::make($_ENV);
    }
}
