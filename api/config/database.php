
<?php
include_once 'DotEnv.php';

class Database{
protected $host;
protected $db_name;
protected $username;
protected $password;
protected $conn;

function __construct()
{
    (new DotEnv(__DIR__ . '/../../.env'))->load();

}


public function getConnection(): ?PDO
{
    $this->host = getenv('DB_HOST');
    $this->db_name = getenv('DB_DATABASE');
    $this->username= getenv('DB_USERNAME');
    $this->password= getenv('DB_PASSWORD');
    $this->conn = null;

    try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
    }
}