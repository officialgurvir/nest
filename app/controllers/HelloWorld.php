<?php

namespace App\Controllers;

use Framework\packages\views\View;
use Framework\Traits\Views;
use Nest\Routing\Request;

class HelloWorld extends View
{
    use Views;

    public function greet(Request $request) {
        return $this->render('index', [
            'name' => $request->name ?? ""
        ]);
    }
}
