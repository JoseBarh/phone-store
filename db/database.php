<?php
class Database{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    public function __construct(){
        $this->host = '';
        $this->db = 'dbdcell';
        $this->user = 'root';
        $this->password = '';
        $this->charset = 'utf8mb4';
        // $this->host = 'fdb28.awardspace.net';
        // $this->db = '3699858_examen';
        // $this->user = '3699858_examen';
        // $this->password = '';
        // $this->charset = 'utf8mb4';
    }
    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}
?>