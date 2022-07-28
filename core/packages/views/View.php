<?php

namespace Framework\packages\views;

use Jenssegers\Blade\Blade;

class View
{
   private Blade $blade;

   public function __construct($environment)
   {
      $this->blade = new Blade(
         $environment['__DIR__'] . '/resources/views',
         __DIR__ . '/cache'
      );
   }

   protected function render($template, $variables = []): string
   {
      try {
         return $this->blade->render($template, $variables);
      } catch (\Exception $e) {
         throw new \Exception($e->getMessage());
      }
   }
}
