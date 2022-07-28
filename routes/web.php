<?php

use Nest\Routing\Router;
use App\Controllers\HelloWorld;

Router::get('/', [HelloWorld::class, 'main']);
Router::get('/greet', [HelloWorld::class, 'greet']);
