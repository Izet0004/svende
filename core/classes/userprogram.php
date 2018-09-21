<?php
class userprogram extends Db{
    public $user_id;
    public $event_id;

    public $events;
    
    public function listArtists(){
        $sql = "SELECT * FROM artist";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function getUserEvents($id){
    $eventsFound = [];
    $sql = "SELECT * from user_event_rel WHERE user_id = :id";
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
    }
    public function getUserEventById($eventId, $userId){
        $sql = "SELECT * from user_event_rel WHERE user_id = :user_id AND event_id = :event_id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":event_id", $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row;
    }
    public function addEvent($eventId, $userId){
        $sql = "INSERT INTO user_event_rel (event_id, user_id) VALUES (:event_id,:user_id)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":event_id", $eventId, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function deleteEvent($eventId, $userId){
        $sql = "DELETE FROM user_event_rel WHERE event_id = :event_id AND user_id = :user_id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":event_id", $eventId, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>