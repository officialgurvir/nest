<?php

use Framework\Contracts\Kernal;

/**
 * Nest - A Next Generation PHP Framework.
 *
 * @author Gurvir Singh <officialgurvir2007@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Requiring the barebones
|--------------------------------------------------------------------------
*/

require __DIR__.'/helpers/index.php';

/*
|--------------------------------------------------------------------------
| Configuring the application
|--------------------------------------------------------------------------
*/

require __DIR__.'/routes/web.php';

$kernal = Kernal::handle(__DIR__);
$kernal->terminate();
