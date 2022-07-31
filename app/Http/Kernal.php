<?php

namespace App\Http;

class Kernal
{
    private array $middlewares = [
        'greet' => [
            \App\Middleware\GreetMiddleware::class,
        ]
    ];

    public function middleware(string $key) {
        return $this->middlewares[$key];
    }
}
