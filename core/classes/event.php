<?php
class Event extends Db{
    public $id;
    public $name;
    public $scene_id;
    public $artist_id;
    public $date;
    
    // JOINS
    public $scene_name;
    public $artist_name;
    public $genre_id;
    public $artist_description;
    public $img_path;
    
    public function getEventByDay($day){
        $eventsFound = [];
        $sql = "SELECT scene.id as scene_id,event.id, event.date, artist.name,artist_id as artist_id, scene.title as scene_title
        FROM EVENT
        INNER JOIN scene ON event.scene_id = scene.id
        INNER JOIN artist ON event.artist_id = artist.id
        ";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        foreach($row as $event){
            $timestamp = strtotime($event["date"]);
            $eventDay = date('l', $timestamp);
            if($eventDay == $day)
            {
                $eventsFound[] = $event;
            }
        }
        return $eventsFound;
    }
    public function listEvents(){
        $sql = "SELECT * FROM event";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listEvent8(){
        $sql = "SELECT * FROM event ORDER BY date_created DESC LIMIT 6";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }

    public function listEventOverview(){
        $sql = "SELECT event.id, event.date, artist.name, scene.title
        FROM event
        INNER JOIN scene ON event.scene_id = scene.id
        INNER JOIN artist ON event.artist_id = artist.id
        INNER JOIN event_genre_rel ON event.id = event_genre_rel.event_id
        INNER JOIN genre ON event_genre_rel.genre_id = genre.id";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listUsersArray(){
        $sql = "SELECT user_id,username,first_name,last_name FROM user";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetch();
        return $row;
    }
    public function getEvent($id){
        $sql = "SELECT event.scene_id, event.artist_id, event.id, event.date, artist.name AS artist_name, scene.title AS scene_title, artist.description, genre.title AS genre_title
        FROM event
        INNER JOIN scene ON event.scene_id = scene.id
        INNER JOIN artist ON event.artist_id = artist.id
        INNER JOIN event_genre_rel ON event.id = event_genre_rel.event_id
        INNER JOIN genre ON event_genre_rel.genre_id = genre.id
        WHERE event.id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->name = $row[0]["artist_name"];
        $this->scene_id = $row[0]["scene_id"];
        $this->artist_id = $row[0]["artist_id"];
        // $this->genresIds = $row[0]["genre_id"];
        return $row;
    }
    public function getEventSingle($id){
        $sql = "SELECT event.scene_id,artist_id, event.id, event.date, artist.name AS artist_name, scene.title AS scene_title, artist.description, genre.title AS genre_title, artist.img_path
        FROM event
        INNER JOIN scene ON event.scene_id = scene.id
        INNER JOIN artist ON event.artist_id = artist.id
        INNER JOIN event_genre_rel ON event.id = event_genre_rel.event_id
        INNER JOIN genre ON event_genre_rel.genre_id = genre.id
        WHERE event.id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->id = $row["id"];
        $this->name= $row["artist_name"];
        $this->description = $row["description"];
        $this->date = $row["date"];
        $this->artist_id = $row["artist_id"];
        $this->scene_id = $row["scene_id"];
        $this->scene_name = $row["scene_title"];
        $this->img_path = $row["img_path"];
        // var_dump($row);
        $this->date = $row["date"];
        // GET GENRE IDS
        $sql2 = "SELECT genre_id FROM event_genre_rel WHERE event_genre_rel.event_id = :id";
        $stmt2 = self::$pdo->prepare($sql2);
        $stmt2->execute([
            ":id" => $id
        ]);
        $row2 = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        $this->genre_id = $row2;
        // $this->genre_id = $row["genre_id"];
        
        return $row;
    }
    public function getLastId(){
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function saveEvent($data){
        $sql = "UPDATE event SET 
        artist_id=:artist,
        scene_id=:scene,
        date=:date
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":artist" => $data[1],
            ":scene" => $data[2],
            ":date" => $data[3]]);
        
        $sql2 = "DELETE FROM event_genre_rel WHERE event_id = :id";
        $stmt2 = self::$pdo->prepare($sql2);
        $stmt2->execute([
            ":id" => $data[0]]);
        foreach($data[4] as $id){
            // var_dump($data[0]);
            $sql3 = 'INSERT into event_genre_rel (event_id, genre_id) VALUES ('.$data[0].' , '.$id.')';
            $stmt3 = self::$pdo->query($sql3);
        }
    }
    public function createEvent($data){
        var_dump($data);
        $sql = "INSERT INTO event (name,description,img_path) VALUES(
        :name,
        :description,
        :img_path)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":name" => $data[0],
            ":description" => $data[1],
            ":img_path" => $data[2],
            ":type_id" => $data[3]]);
    }

    public function deleteEvent($id){
        // DELETE EVENT
        $sql2 = "DELETE FROM event_genre_rel WHERE event_id = :id";
        $stmt2 = self::$pdo->prepare($sql2);
        $stmt2->execute([
            ":id" => $id]);
        $sql = "DELETE FROM event WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function uploadEventImg($file){
        $galleryPath = DOCROOT . "../assets/data/fotos/eventer/";
        if ($file) {
            $imgFile = $_FILES["img_path"]; // Get file from submitted data
        
            // All information from file
            $fileName = $_FILES['img_path']['name']; // Get the name of file asctotiacito array
            $fileTmpName = $_FILES["img_path"]["tmp_name"]; // Temporary file before upload
            $fileSize = $_FILES["img_path"]["size"]; // Size of file
            $fileType = $_FILES["img_path"]["type"]; // Type of file
            $fileError = $_FILES["img_path"]["error"]; // Error status
        
            if(exif_imagetype($fileTmpName) == IMAGETYPE_JPEG || exif_imagetype($fileTmpName) == IMAGETYPE_PNG){ // Checks for some standard requirements
                if($fileError === 0){
                    if($fileSize <= 2000000){
                        if(!file_exists($galleryPath . $fileName)){
                            move_uploaded_file($fileTmpName, $galleryPath . $fileName);
                            return $fileName;
                        } else {
                            echo "File already exist!";
                        }
        
                    } else {
                        echo "File to big, try compressing it";
                    }
                } else {
                    echo "Something went wrong in the upload process";
                }
            } else {
                echo "Wrong image format";
            }   
        } else {
            return "stock.jpg";
        }
        }

    }
?>