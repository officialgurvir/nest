<?php
namespace Nest\Foundation;

class Application {
   protected array $environment;

   public function __construct(array $environment) {
      $this->environment = $environment;
   }

   public function terminate() {
      print_array($this->environment);
   }

   public static function make(array $environment) {
      return new self($environment);
   }
}