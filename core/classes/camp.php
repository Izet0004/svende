<?php
class Camp extends Db{
    public $id;
    public $title;
    public $description;
    public $space;
    public $img_path;
    
 
    public function listCamps(){
        $sql = "SELECT * FROM camp ORDER BY date_created ASC";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listCamps8(){
        $sql = "SELECT * FROM camp ORDER BY date_created DESC LIMIT 6";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listCampsOverview(){
        $sql = "SELECT id, title, space FROM camp";
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
    public function getCamp($id){
        $sql = "SELECT * FROM camp WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->title = $row[0]["title"];
        $this->description = $row[0]["description"];
        $this->img_path = $row[0]["img_path"];
        $this->space = $row[0]["space"];
        return $row;
    }
    public function getCampSingle($id){
        $sql = "SELECT id, title, description, img_path, space FROM camp WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["id"];
        $this->title = $row[0]["title"];
        $this->description = $row[0]["description"];
        $this->img_path = $row[0]["img_path"];
        $this->space = $row[0]["space"];
        return $row;
    }
    public function getLastId(){
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function saveCamp($data){
        $sql = "UPDATE camp SET 
        title=:title,
        description=:description,
        img_path=:img_path,
        space=:space
        WHERE id = :id";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":id" => $data[0],
            ":title" => $data[1],
            ":description" => $data[2],
            ":img_path" => $data[3],
            ":space" => $data[4]]);
    }
    public function createCamp($data){
        var_dump($data);
        $sql = "INSERT INTO camp (title,description,img_path,space) VALUES(
        :title,
        :description,
        :img_path,
        :space)";
        // $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":title" => $data[0],
            ":description" => $data[1],
            ":img_path" => $data[2],
            ":space" => $data[3]]);
    }

    public function deleteCamps($id){
        // DELETE USER
        $sql = "DELETE FROM camp WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function uploadCampsImg($file){
        $galleryPath = DOCROOT . "../assets/data/fotos/indhold/";
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