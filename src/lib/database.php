<?php

namespace Application\Lib\Database;

use PDO;

abstract class DatabaseConnection
{
    protected $database;

    protected function __construct(array $env)
    {
        try {
            if (isset($env['host_name'], $env['host_user'], $env['host_pwd'], $env['host_dbname'])) {
                // Inclure charset=utf8mb4 dans la chaîne DSN
                $dsn = "mysql:host={$env['host_name']};dbname={$env['host_dbname']};charset=utf8mb4";

                $this->database = new PDO($dsn, $env['host_user'], $env['host_pwd']);
                $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } else {
                throw new \Exception("Impossible de charger les variables d'environnement ou des variables requises manquantes.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->database;
    }

    public function lastInsertId()
    {
        return $this->database->lastInsertId();
    }
}


