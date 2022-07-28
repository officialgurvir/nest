<?php

namespace App\Controllers;

class HelloWorld
{
    public function main()
    {
        return print_array($_SERVER);
    }
}
