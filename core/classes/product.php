<?php
class Product extends Db{
    // PRODUCT PROPERTIES
    public $proId;
    public $proName;
    public $proDescription;
    public $proCategoryId;
    public $proImagePath;
    public $proDateCreated;
    // CATEGORY PROPERTIES
    public $catId;
    public $catName;
    // INGRIDIENT PROPERTIES
    public $ingId;
    public $ingName;

    public function getProduct($id){
        $sql = "SELECT * FROM product
        INNER JOIN category ON product.category_id = category.id
        WHERE product.id = :id";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll();
        $this->proId = $row["id"];
        $this->proName = $row["name"];
        $this->proDescription = $row["description"];
        $this->proCategoryId = $row["category_id"];
        $this->proImagePath = $row["image_path"];
        $this->proDateCreated = $row["date_created"];
        $this->catName = $row["category_name"];
    }
    public function getProductSingle($id){
        $sql = "SELECT * FROM product
        INNER JOIN category ON product.category_id = category.id
        WHERE product.id = :id";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->proId = $row["id"];
        $this->proName = $row["name"];
        $this->proDescription = $row["description"];
        $this->proCategoryId = $row["category_id"];
        $this->proImagePath = $row["image_path"];
        $this->proDateCreated = $row["date_created"];
        $this->catName = $row["category_name"];
    }
    public function listProducts(){
        $sql = "SELECT * FROM product
        INNER JOIN category ON product.category_id = category.id";
        $stmt = parent::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }
    public function listNewestProducts(){
        $sql = "SELECT * FROM product
        INNER JOIN category ON product.category_id = category.id LIMIT 8";
        $stmt = parent::$pdo->query($sql);
        $row = $stmt->fetchAll();
        return $row;
    }

}
?>