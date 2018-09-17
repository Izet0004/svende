<?php
class Newsletter extends Db{
    public $id;
    public $email;
    public $isActive;

    public function signUp($email){
        $sql = "INSERT INTO newsletter VALUES ('',:email,1)";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function signOut($email){
        // DELETE
    }
}
?>