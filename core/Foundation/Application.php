<?php

namespace Nest\Foundation;

class Application
{
    protected array $environment;

    public function __construct(array $environment)
    {
        $this->environment = $environment;
    }

    public function terminate()
    {
       exit;
    }

    public static function make(array $environment)
    {
        return new self($environment);
    }
}
