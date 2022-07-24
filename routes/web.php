<?php

use App\Controllers\HelloWorld;
use Nest\Routing\Router;

Router::get('/', [HelloWorld::class, 'main']);
