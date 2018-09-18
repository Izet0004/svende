<?php
class Db{
    
    private $host = "sql.itcn.dk:3306";
    private $dbName = "izet0004.SKOLE";
    private $dbUsername = "izet0004.SKOLE";
    private $dbPassword = "HvchT1M054";
    private $charset = "utf8mb4";
    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // assoc
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_PERSISTENT => true
    ];
    public static $pdo;

    public function __construct(){
        try{
            $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=$this->charset";
            self::$pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword, $this->opt);
        } catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }

}
?>