<?php
class User extends Db{
    public $id;
    public $username;
    public $firstName;
    public $lastName;
    public $name;
    public $email;
    public $imgPath;
    public $address;
    public $isSuspended;
    public $dateCreated;
    public $phone;
    public $roleId;
    public $roles = ["Admin" => "1", "Member" => "2"];
    
    /**
     * Check if user exists and password is correct for the user
     * 
     *
     * @param STRING $username
     * @param STRING $password
     * @return void
     */
    public function checkUser($email, $password){
        // SQL query, prepare statement and bind params, and execute.
        $sql = "SELECT user_id, email, password FROM user WHERE email = :email";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if(!empty($row)){
            if(password_verify($password, $row["password"])){
                $_SESSION["email"] = $email;
                $_SESSION["userId"] = $row["user_id"];
                $this->email = $email;
                $this->id = $row["user_id"];
                $this->roleId = $this->getUserRole($row["user_id"]);
                return true;
            } else {
                return false;
        }} else {
            return false;
        }
    }
    /**
     * Get User Role
     *
     * @param INT $id
     * @return role_id
     */
    public function getUserRole($id){
        $sql = "SELECT role_id FROM userroles_rel WHERE user_id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function listUsers(){
        $sql = "SELECT user_id,email,name FROM user";
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
    public function getUser($id){
        $sql = "SELECT user_id,email,name,address,zip,is_suspended,date_created FROM user WHERE user_id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->id = $row[0]["user_id"];
        $this->name = $row[0]["name"];
        $this->email = $row[0]["email"];
        $this->isSuspended = $row[0]["is_suspended"];
        $this->dateCreated = $row[0]["date_created"];
        $this->roleId = $this->getUserRole($row[0]["user_id"]);
        return $row;
    }
    public function getUserSingle($id){
        $sql = "SELECT user_id,email,name,is_suspended,zip,address,date_created FROM user WHERE user_id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->id = $row["user_id"];
        $this->name= $row["name"];
        $this->email = $row["email"];
        $this->isSuspended = $row["is_suspended"];
        $this->dateCreated = $row["date_created"];
        $this->zip = $row["zip"];
        $this->address = $row["address"];
        $this->roleId = $this->getUserRole($row["user_id"]);
        return $row;
    }
    public function getLastId(){
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $stmt = self::$pdo->query($sql);
        $row = $stmt->fetchColumn();
        return $row;
    }
    public function saveUser($data){
        var_dump($data);
        $sql = "UPDATE user SET 
        email=:email,
        name=:name,
        is_suspended=:is_suspended,
        zip=:zip,
        address=:address
        WHERE user_id = :userId";
        $data["isSuspended"]->value == "Ja" ? $data["isSuspended"]->value = "1" : $data["isSuspended"]->value = "0";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ":email" => $data["email"]->value,
            ":name" => $data["name"]->value,
            ":address" => $data["address"]->value,
            ":is_suspended" => $data["isSuspended"]->value,
            ":zip" => $data["zip"]->value,
            ":address" => $data["address"]->value,
            ":userId" => $data["userId"]->value,
        ]);

        // Roles
        $sql2 = "UPDATE userroles_rel SET role_id=:role_id WHERE user_id = :user_id";
        $stmt2 = self::$pdo->prepare($sql2);
        $data["role"]->value == "Admin" ? $data["role"]->value = 1 : $data["role"]->value = 2;
        $stmt2->execute([
            ":role_id" => $data["role"]->value,
            ":user_id" => $data["userId"]->value
        ]);
    }
    public function createUser($data){
        $sql = "INSERT INTO user (name, email,zip, address, password) VALUES (
        :name,
        :email,
        :zip,
        :address,
        :password)";
        $stmt = self::$pdo->prepare($sql);
        $hashedPass = password_hash($data["password"]->value, PASSWORD_BCRYPT);
        $stmt->execute([
            ":name" => $data["name"]->value,
            ":email" => $data["email"]->value,
            ":zip" => $data["zip"]->value,
            ":address" => $data["address"]->value,
            ":password" => $hashedPass
        ]);

        // Roles
        $sql2 = "INSERT INTO userroles_rel (role_id, user_id) VALUES (:role_id,:user_id)";
        $stmt2 = self::$pdo->prepare($sql2);
        $data["role"]->value == "Admin" ? $data["role"]->value = 1 : $data["role"]->value = 2;
        $stmt2->execute([
            ":role_id" => $data["role"]->value,
            ":user_id" => $this->getLastId()
        ]);
    }
    // public function saveUser($data){
    //     $sql = "UPDATE user SET 
    //     username = :username,
    //     first_name = :first_name,
    //     last_name = :last_name,
    //     address = :address,
    //     zip = :zip,
    //     img_path = :img_path,
    //     phone = :phone,
    //     email = :email, 
    //     is_suspended = :is_suspended
    //     WHERE user_id = :userId";
    //     $stmt = self::$pdo->prepare($sql);
    //     $stmt->execute([
    //         ":username" => $data["username"]->value,
    //         ":first_name" => $data["firstName"]->value,
    //         ":last_name" => $data["lastName"]->value,
    //         ":address" => $data["address"]->value,
    //         ":zip" => $data["zip"]->value,
    //         ":img_path" => $data["imgPath"]->value,
    //         ":phone" => $data["phone"]->value,
    //         ":email" => $data["email"]->value,
    //         ":is_suspended" => $data["isSuspended"]->value,
    //         ":userId" => $data["userId"]->value,
    //     ]);
    // }
    public function createUsers($username, $password, $firstName, $lastName, $email, $avatarPath = "stock.png", $roleId = 2){
        // Should be in SQL DEFAULT = 1 <<<<<<<<<<<<
        // AVATAR_PATH SHOULD BE STOCK <<<<<<<<<<<<<
        // $lastId = $this->getLastId() + 1;
        $sql = "INSERT INTO user(username,password,first_name,last_name,email,avatar_path) VALUES (:username, :password, :firstName, :lastName, :email, :avatarpath)";
        $sql2 = "INSERT INTO usersroles_rel VALUES (:user_id, :role_id)";
        $stmt = self::$pdo->prepare($sql);
        $hashedPass = password_hash($password, PASSWORD_BCRYPT);
        // Can be shortened with ARRAY, if all STRING
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":avatarpath", $avatarpath, PDO::PARAM_STR);
        $stmt->execute();
        $lastId = self::$pdo->lastInsertId();
        // Insert role, if no role defined, standard role 2 = member
        $stmt2 = self::$pdo->prepare($sql2);
        $stmt2->bindParam(":user_id", $lastId, PDO::PARAM_INT);
        $stmt2->bindParam(":role_id", $roleId, PDO::PARAM_INT);
        $stmt2->execute();
    }
    public function updateUser($data){
        // User update
        $sql = "UPDATE user SET
        name = :name,
        address = :address,
        zip = :zip
        WHERE user_id = :id";
        // Update the user row
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            "id" => $data["userId"],
            ":name" => $data["name"],
            ":address" => $data["address"],
            ":zip" => $data["zip"]
        ]);
    }
    public function deleteUser($id){
        // DELETE ROLES
        $sql = "DELETE FROM userroles_rel WHERE user_id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        // DELETE USER
        $sql = "DELETE FROM user WHERE user_id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function uploadUserAvatar($file){
        $galleryPath = DOCROOT . "/assets/images/userimages/";
        if ($file) {
            $imgFile = $_FILES["avatar"]; // Get file from submitted data
        
            // All information from file
            $fileName = $_FILES['avatar']['name']; // Get the name of file asctotiacito array
            $fileTmpName = $_FILES["avatar"]["tmp_name"]; // Temporary file before upload
            $fileSize = $_FILES["avatar"]["size"]; // Size of file
            $fileType = $_FILES["avatar"]["type"]; // Type of file
            $fileError = $_FILES["avatar"]["error"]; // Error status
        
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