<?php
class DatabaseConnector {
    private $host = "localhost";
    private $username = "username";
    private $password = "password";
    private $dbname = "myDatabase";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function fetchAll($tableName) {
        $stmt = $this->conn->prepare("SELECT * FROM {$tableName}");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "id: " . $row['id'] . " - Name: " . $row['name'] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    public function close() {
        $this->conn = null;
    }
}

$db = new DatabaseConnector();
$db->fetchAll("yourTable");
$db->close();
?>


