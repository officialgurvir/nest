<?php

use App\Controllers\HelloWorld;
use Nest\Router;

Router::get('/', [HelloWorld::class, 'main']);
