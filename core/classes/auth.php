<?php
class Auth extends Db
{
    public $userId;
    public $forbidden = "HTTP/1.0 403 Forbidden";
    public function __construct(){
        session_start();
        if(isset($_SESSION["userId"])){
            if($_SESSION["userId"] > 0){
                $this->userId = $_SESSION["userId"];
            }
        }
    }
    public function isAdmin(){
        // sql if THIS id is found within userroles with id 1, return true, else false
        $sql = "SELECT role_id FROM userroles_rel WHERE user_id = :id";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":id", $this->userId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row["role_id"] == 1){
            return true;
        } else {
            return false;
        }
    }
    public function isMember(){
        // sql if THIS id is found within userroles with id 1, return true, else false
        $sql = "SELECT role_id FROM userroles_rel WHERE user_id = :id";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":id", $this->userId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row["role_id"] == 2){
            return true;
        } else {
            return false;
        }
    }
}

?>