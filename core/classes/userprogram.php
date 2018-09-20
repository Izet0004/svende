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
}
?>