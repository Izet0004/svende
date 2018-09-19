<?php
class Type extends Db{
    public $id;
    public $title;
    
    public function listTypes(){
        $sql = "SELECT * FROM type";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listSceneOverview(){
        $sql = "SELECT id, title FROM scene ORDER BY date_created ASC";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function getType($id){
        $sql = "SELECT * FROM type WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->title = $row[0]["title"];
        return $row;
    }
    public function getTypeSingle($id){
        $sql = "SELECT id, title FROM type WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->id = $row["id"];
        $this->title= $row["title"];
        return $row;
    }
    public function getLastId(){
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function saveType($data){
        $sql = "UPDATE type SET 
        title=:title
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":title" => $data[1]]);
    }
    public function createType($data){
        var_dump($data);
        $sql = "INSERT INTO type (title) VALUES(
        :title)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":title" => $data[0]]);
    }

    public function deleteType($id){
        // DELETE USER
        $sql = "DELETE FROM type WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    }
?>