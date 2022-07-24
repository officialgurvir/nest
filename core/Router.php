<?php

namespace Nest;

class Router
{
   private static array $paths = [
      "GET" => [],
      "POST" => []
   ];

   public static function get($path, $callback)
   {
      self::$paths['GET'][$path] = [
         new $callback[0],
         $callback[1]
      ];
   }

   public static function post($path, $callback)
   {
      self::$paths['POST'][$path] = [
         new $callback[0],
         $callback[1]
      ];
   }

   /**
    * TODO: Make routing work for functions as well.
    * 
    * @return boolean
    */
   private static function functionResolver($callback): bool
   {
      return false;
   }

   /**
    * It requires a [ class, method ]. 
    *
    * @param array $callback
    * @return boolean
    */
   private static function classResolver(array $callback): bool
   {
      if (count($callback) < 2)
         /**
          * TODO: Write up an error.
          */
         throw new \Exception('');

      $class = $callback[0];
      $method = $callback[1];

      $reflection = new \ReflectionClass($class);
      $parameters = $reflection->getMethod($method)->getParameters();
      $arguments = [];

      foreach ($parameters as $parameter) {
         $dependency = $parameter->getType()->getName();
         $arguments[] = new $dependency;
      }

      $code = call_user_func_array(
         [
            new $class,
            $method
         ],
         $arguments
      );

      eval(sprintf(" ?> %s <?php ", $code));
      return true;
   }

   /**
    * TODO: Implement routing using classResolver and functionResolver.
    *
    * @return void
    */

   public static function resolve()
   {
   }
}
