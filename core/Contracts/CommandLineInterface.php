<?php

namespace Framework\Contracts;

use Framework\packages\nesm\Database;

class CommandLineInterface
{
   private Database $database;

   /**
    * @throws Exception
    */
   public function __construct($command)
   {
      $this->database = new Database();

      $arguments = explode(":", $command);
      $executor = $arguments[0];

      if (method_exists($this, $executor)) {
         if (count($arguments) > 1)
            $this->$executor($arguments);
         else
            $this->$executor();
      } else throw new \Exception("$arguments[0] command does not exists.");
   }

   /**
    * @throws Exception
    */
   public function migrate(): void
   {
      $this->database->applyMigrations();
   }

   /**
    * @throws Exception
    */
   public function drop($table): void
   {
      $this->database->dropTable($table[1]);
   }

  public function terminate(): void
   {
      exit(1);
   }
}