<?php

namespace Framework\packages\nesm;

class Database {
    protected \PDO $pdo;
    protected string $table;
    protected static string $class_name;
 
    public function __construct() {
       $dsn = concat(
          "mysql",
          ":host",
          $_ENV['DB_HOST'],
          ";port=3306",
          ";dbname=",
          $_ENV['DB_NAME']
       );
 
       $this->pdo = new \PDO(
          $dsn,
          $_ENV['DB_USER'],
          $_ENV['DB_PASS']
       );
 
       $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
 
    /**
     * @throws Exception
     */
    public function applyMigrations() {
       $this->record();
       $applied = $this->getAppliedMigrations();
 
       $files = scandir(
          concat(
             exec('pwd'),
             '/migrations'
          )
       );
 
       $migrations = array_diff($files, $applied);
 
       foreach ($migrations as $migration) {
          if ($migration === '.')
             continue;
 
          if ($migration === '..')
             continue;
 
          self::$class_name = $migration;
          require_once concat(
             exec('pwd'),
             '/migrations/',
             $migration
          );
 
          $class_name = pathinfo($migration, PATHINFO_FILENAME);
          $instance = new $class_name;
 
          if (method_exists($instance, 'up')) {
             echo "Applying migration -> $migration" . PHP_EOL;
             $instance->up();
             echo "Applied migration -> $migration" . PHP_EOL;
          } else throw new \Exception("No migration `up` method found in $migration");
       }
    }
 
    /**
     * @throws Exception
     */
    public function dropTable($migration)
    {
       require_once concat(
          exec('pwd'),
          '/migrations/',
          $migration,
          ".php"
       );
 
       $instance = new $migration;
 
       if (method_exists($instance, 'down')) {
          echo "Undoing migration -> $migration" . PHP_EOL;
          $instance->down();
          echo "Undone migration -> $migration" . PHP_EOL;
       } else throw new \Exception("No migration `down` method found in $migration");
    }
 
    /**
     * @throws Exception
     */
    public function trigger($sql, $vars = []) {
       $statement = $this->pdo->prepare($sql);
       $statement->execute($vars);
 
       return $statement;
    }
 
    private function getAppliedMigrations() : array
    {
       $statement = $this->pdo->prepare("SELECT migration_class FROM migrations");
       $statement->execute();
 
       return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
 
    private function record() {
       $this->pdo->exec(statement: "
          CREATE TABLE IF NOT EXISTS migrations (
              id INT AUTO_INCREMENT PRIMARY KEY,
              migration VARCHAR(255),
              migration_class VARCHAR(255),
              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
          ) ENGINE=INNODB;
       ");
    }
 
    public function resolve() {
       $this->record();
    }
 }