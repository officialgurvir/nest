<?php

namespace Framework\Traits;

use Framework\packages\views\View;

trait Views
{
    public function __construct(array $env = [])
    {
        parent::__construct($env);
    }
}
