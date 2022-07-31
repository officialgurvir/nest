<?php

use Nest\Routing\Router;
use App\Controllers\HelloWorld;

Router::any('/', 'greet', [HelloWorld::class, 'greet']);
