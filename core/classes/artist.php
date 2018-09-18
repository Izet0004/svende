<?php
class Artist extends Db{
    public $id;
    public $name;
    public $description;
    public $img_path;
    
 
    public function listArtists(){
        $sql = "SELECT * FROM artist";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listArtist8(){
        $sql = "SELECT * FROM artist ORDER BY date_created DESC LIMIT 6";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listArtistOverview(){
        $sql = "SELECT id, name FROM artist";
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
    public function getArtist($id){
        $sql = "SELECT * FROM artist WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->name = $row[0]["name"];
        $this->description = $row[0]["description"];
        $this->img_path = $row[0]["img_path"];
        return $row;
    }
    public function getArtistSingle($id){
        $sql = "SELECT id, name, description, img_path FROM artist WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->id = $row["id"];
        $this->name= $row["name"];
        $this->description = $row["description"];
        $this->img_path = $row["img_path"];
        return $row;
    }
    public function getLastId(){
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function saveArtist($data){
        $sql = "UPDATE artist SET 
        name=:name,
        description=:description,
        img_path=:img_path,
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":name" => $data[1],
            ":description" => $data[2],
            ":img_path" => $data[3]]);
    }
    public function createArtist($data){
        var_dump($data);
        $sql = "INSERT INTO artist (name,description,img_path) VALUES(
        :name,
        :description,
        :img_path)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":name" => $data[0],
            ":description" => $data[1],
            ":img_path" => $data[2]]);
    }

    public function deleteArtist($id){
        // DELETE USER
        $sql = "DELETE FROM artist WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function uploadArtistImg($file){
        $galleryPath = DOCROOT . "../assets/data/fotos/artister/";
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