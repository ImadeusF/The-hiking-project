<?php

namespace Application\Model;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;
//avoid error using native class PDO
use PDO;

class Login extends DatabaseConnection
{
    private string $username;
    private string $password_crypt;
    private DatabaseConnection $connection;

    public function __construct(array $env)
    {
        parent::__construct($env);
    }
    
    public function existEmail($email)
    {
    $statement = $this->getConnection()->prepare("SELECT id, nickname, email, password, user_admin FROM hikesusers WHERE email = :email");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
    }
}

