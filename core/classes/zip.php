<?php
class Zip extends Db{
    public $zip;
    public $city;

    public function getCityByZip($zip){
        $sql = "SELECT city from zip_code WHERE zip_id = :zip";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":zip", $zip, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchColumn();
        return $row;
    }
}
?>