<?php
class Overview extends Db{
    public $id;
    public $email;
    public $isActive;

    public function showCount($marker, $table){
        $sql = "SELECT COUNT(:marker) FROM $table";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":marker", $marker, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function signOut($email){
        // DELETE
    }
}
?>