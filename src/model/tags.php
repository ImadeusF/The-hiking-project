<?php

namespace Application\Model;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;
//avoid error using native class PDO
use PDO;

class Tags extends DatabaseConnection
{
  private int $id;
  private string $name;

  public function __construct(array $env)
    {
        parent::__construct($env);
    }

  public function getTags()
  {
    $statement = $this->getConnection()->prepare(
      "SELECT id, name FROM hikestags ORDER BY name ASC"
    );
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}
