<?php
class Scene extends Db{
    public $id;
    public $title;
    
    public function listScenes(){
        $sql = "SELECT * FROM scene";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listNews8(){
        $sql = "SELECT * FROM news ORDER BY date_created DESC LIMIT 6";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listSceneOverview(){
        $sql = "SELECT id, title, date_created FROM news ORDER BY date_created ASC";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function getScene($id){
        $sql = "SELECT * FROM scene WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->title = $row[0]["title"];
        return $row;
    }
    public function getSceneSingle($id){
        $sql = "SELECT id, title FROM scene WHERE id = :id";
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
    public function saveScene($data){
        $sql = "UPDATE scene SET 
        title=:title
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":title" => $data[1]]);
    }
    public function createScene($data){
        var_dump($data);
        $sql = "INSERT INTO scene (title) VALUES(
        :title)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":title" => $data[0]]);
    }

    public function deleteScene($id){
        // DELETE USER
        $sql = "DELETE FROM scene WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    }
?>