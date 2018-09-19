<?php
class Genre extends Db{
    public $id;
    public $title;
    
    public function listGenres(){
        $sql = "SELECT * FROM genre";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function getGenreIds($id){
        $sql = "SELECT id, title FROM events_genre_rel WHERE event.id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listGenreOverview(){
        $sql = "SELECT id, title FROM genre";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function getGenre($id){
        $sql = "SELECT * FROM genre WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->title = $row[0]["title"];
        return $row;
    }
    public function getGenreSingle($id){
        $sql = "SELECT id, title FROM genre WHERE id = :id";
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
    public function saveGenre($data){
        $sql = "UPDATE genre SET 
        title=:title
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":title" => $data[1]]);
    }
    public function createGenre($data){
        var_dump($data);
        $sql = "INSERT INTO genre (title) VALUES(
        :title)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":title" => $data[0]]);
    }

    public function deleteGenre($id){
        // DELETE USER
        $sql = "DELETE FROM genre WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    }
?>