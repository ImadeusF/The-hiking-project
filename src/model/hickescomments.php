<?php

namespace Application\Model;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;
//avoid error using native class PDO
use PDO;

class HikesComments Extends DatabaseConnection
{
    public function __construct(array $env)
    {
        parent::__construct($env);
    }

    public function addCommentHicke($hikescomments, $idhike, $iduser, $posted)
    {
        $statement = $this->getConnection()->prepare(
            "INSERT INTO hikescomments (hikes_comments, id_hikes, id_user, posted_at) VALUES (:hikes_comments, :id_hikes , :id_user, :posted_at)"
        );
        $statement->bindParam(':hikes_comments', $hikescomments, PDO::PARAM_STR);
        $statement->bindParam(':id_hikes', $idhike, PDO::PARAM_INT);
        $statement->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $statement->bindParam(':posted_at', $posted, PDO::PARAM_STR);
        $result = $statement->execute();
        return $result;
    }

    public function delCommentHicke($commentid)
    {
        $statement = $this->getConnection()->prepare(
            "DELETE FROM hikescomments WHERE id = :id"
        );
        $statement->bindParam(':id', $commentid, PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }

    public function getCommentHicke($identifier)
    {
        $statement = $this->getConnection()->prepare(
            "SELECT * FROM hikescomments WHERE id = :id"
        );
        $statement->bindParam(':id', $identifier, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    public function editCommentHicke($identifier, $message)
    {
        $statement = $this->getConnection()->prepare(
            "UPDATE hikescomments SET hikes_comments = :hikes_comments WHERE id = :id"
        );
        $statement->bindParam(':hikes_comments', $message, PDO::PARAM_STR);
        $statement->bindParam(':id', $identifier, PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }

    //delete all comments when a user delete his profil
    public function DelAllCommentHicke($userid)
    {
        $statement = $this->getConnection()->prepare(
            "DELETE FROM hikescomments WHERE id_user = :id_user"
        );
        $statement->bindParam(':id_user', $userid, PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }

}
