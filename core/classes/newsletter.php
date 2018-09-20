<?php
class Newsletter extends Db{
    public $id;
    public $email;
    
    public function listNewsletters(){
        $sql = "SELECT * FROM newsletter";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listNewsletterOverview(){
        $sql = "SELECT id, email FROM newsletter ORDER BY date_created ASC";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function getNewsletter($id){
        $sql = "SELECT * FROM newsletter WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->email = $row[0]["email"];
        return $row;
    }
    public function getNewsletterSingle($id){
        $sql = "SELECT id, email FROM newsletter WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->id = $row["id"];
        $this->email= $row["email"];
        return $row;
    }
    public function getLastId(){
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function saveNewsletter($data){
        $sql = "UPDATE newsletter SET 
        email=:email
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":email" => $data[1]]);
    }
    public function createNewsletter($data){
        var_dump($data);
        $sql = "INSERT INTO newsletter (email) VALUES(
        :email)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":email" => $data[0]]);
    }
    public function signUp($email){
        $sql = "INSERT INTO newsletter (email) VALUES (:email)";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function deleteNewsletter($id){
        // DELETE USER
        $sql = "DELETE FROM newsletter WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    }
?>