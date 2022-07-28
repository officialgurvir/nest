<?php

use Nest\Routing\Router;
use App\Controllers\HelloWorld;

Router::get('/', [HelloWorld::class, 'main']);
