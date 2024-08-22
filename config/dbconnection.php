<?php
class DB_Connection {
 
    private $servername = "127.0.0.1:3308";
    private $username = "root";
    private $password = "";
    private $dbname = "progettoict";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        /*echo "connessione ok";*/
        if ($this->conn->connect_error) {
            /*echo "connessione ko";*/
            die("Connessione fallita: " . $this->conn->connect_error);
            
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }

    
}
?>
