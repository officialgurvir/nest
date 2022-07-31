<?php

namespace App\Middleware;

use Nest\Routing\Request;

class GreetMiddleware
{
   public function handle(Request $request)
   {
      if (!isset($request->name)) return true;
      else if ($request->name === "Admin") {
         return false;
      } else {
         return true;
      }
   }
}
