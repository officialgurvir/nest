<?php

namespace Framework\Foundation;

use Nest\Routing\Router;

class Application
{
    protected Router $router;
    protected array $environment;

    public function __construct(array $environment)
    {      
       $this->router = new Router;
       $this->environment = $environment;
    }

    public function terminate()
    {
        $_ENV = [];
        $this->router->execute($this->environment);
    }

    public static function make(array $environment)
    {
        return new self($environment);
    }
}
