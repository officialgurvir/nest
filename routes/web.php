<?php

use Nest\Routing\Router;
use App\Controllers\HelloWorld;

Router::any('/', [HelloWorld::class, 'greet']);
