<?php
// include("../controllers/Auth.php");
namespace src\models;
class Database
{
    private $server;
    private $dbUser;
    private $dbPassword;
    private $dbName;
    private $adminuser;
    private $adminpass;
    private $email;
    private static $instance = null;
    private $conn;

    private function __construct($db)
    {
        // get database details from config file 
            // echo "here";
            $this->server = $db['server'];
            $this->adminuser = $db['username'];
            $this->adminpass = $db['password'];
            $this->dbUser = $db['dbuser'];
            $this->dbPassword = $db['dbpass'];
            $this->dbName = $db['dbname'];
            $this->email = $db['email'];
    }
     
    // creating instance of the db class 
    public static function getInstance($db)
    {
        if (!self::$instance) {
            self::$instance = new Database($db);
        }
        return self::$instance;
    }
     
    // function to create connection
    public function getConnection()
    {

        $this->conn = new \mysqli($this->server, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->conn->connect_error) {
            // echo "here";
            // throw new \Exception('Connection error: ' . $this->conn->connect_error);
        }
        else{
            // echo "connested";
        }
    }

    // function to close the connection
    public function closeConnection()
    {
        $this->conn->close();
    }

    // function to get record from particular table with conditions
    public function getRecord($table, $query)
    {
        
        $sql = "SELECT * FROM $table WHERE ";
        $dataType = '';
        foreach ($query as $key => $value) {
            $sql .= $key . "=" . "?" .  " AND ";
            if (is_int($value)) {
                $dataType .= 'i';
            } elseif (is_float($value)) {
                $dataType .= 'd';
            } elseif (is_string($value)) {
                $dataType .= 's';
            } else {
                $dataType .= 'b';
            }
        }
        
        $sql = rtrim($sql," AND ");
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $params = array_values($query);
            $stmt->bind_param($dataType, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            // throw new Exception('Query execution error: ' . $this->conn->error);
        }
        
    }

    // function to get all records from particular table
    public function getRecords($table)
    {
        $sql = "SELECT * FROM $table";
        $result = $this->conn->query($sql);
        if (!$result) {
            // throw new Exception('Query execution error: ' . $this->conn->error);
        }
        return $result;
    }

    // function to insert record into table
    public function insertRecord($table, $data)
    {

        $sql = "INSERT INTO $table (";
        $question = '';
        $dataType = '';

        foreach ($data as $key => $value) {
            $sql .= $key . ',';
            $question.= '?,';
            if (is_int($value)) {
                $dataType .= 'i';
            } elseif (is_float($value)) {
                $dataType .= 'd';
            } elseif (is_string($value)) {
                $dataType .= 's';
            } else {
                $dataType .= 'b';
            }
        }
        $sql = rtrim($sql, ',') . ') VALUES (' . rtrim($question, ',') . ')';
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $params = array_values($data);
            $stmt->bind_param($dataType, ...$params);
            $stmt->execute();
            $id = $this->conn->insert_id;
            $stmt->close();
            return $id;
        } else {
            throw new \Exception('Query execution error: ' . $this->conn->error);
        }
    }

    // function to update record of particular table
    public function updateRecord($table, $data, $query){
        $dataType1 = "";
        $dataType2 = "";
        $sql = "UPDATE $table SET ";
        foreach( $data as $key => $value ) {
            $sql .= $key . ' = ?, ';
            $dataType1 .= "s";
        }
        $sql = rtrim($sql,", ");
        $sql .= " WHERE ";
        foreach( $query as $key => $value ) {
            $sql .= $key . " = ?". " AND ";
            $dataType2 .= "i";
        }
        $sql = rtrim($sql," AND ");
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $params = array_merge(array_values($data), array_values($query));
            $dataTypes = $dataType1 . $dataType2;
            $stmt->bind_param($dataTypes, ...$params);
            $stmt->execute();
            $stmt->close();
        } else {
            // throw new Exception("Cannot update Record: " . $this->conn->error);
        }
    }
    
    // funciton to delete record 
    public function deleteRecord($table, $query){
        $sql = "DELETE FROM $table WHERE ";
        $dataType = "";
        foreach ($query as $key => $value) {
            $sql .= $key . " = " . "? AND ";
            $dataType.='i';
        }

        $sql = rtrim($sql," AND ");
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $params = array_values($query);
            $stmt->bind_param($dataType, ...$params);
            $stmt->execute();
            $stmt->close();
        }
    }

    // function to create database 
    public function initializeDatabase()
    {
        $this->conn = new \mysqli($this->server, $this->dbUser, $this->dbPassword);
        if ($this->conn->connect_error) {
            // throw new Exception("Connection failed" . $this->conn->connect_error);
        }

        $sql_db = "Create DATABASE $this->dbName";
        if ($this->conn->query($sql_db) === TRUE) {
            echo "Database created successfully";
        } else {
            // throw new Exception("Dtabase not created" . $this->conn->error);
        }
        $this->createTables();
    }

    // function to create database tables
    public function createTables()
    {
        $this->getConnection();
        $table_user = "CREATE TABLE USER(
            id INT PRIMARY KEY AUTO_INCREMENT, 
            username VARCHAR(255) UNIQUE, email VARCHAR(255) UNIQUE, 
            password VARCHAR(255),
            isAdmin VARCHAR(50) DEFAULT 'no', 
            created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $table_courses = "CREATE TABLE COURSE(
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            url VARCHAR(255),
            details VARCHAR(255)
        )";

        $table_section = "CREATE TABLE SECTION(
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            details VARCHAR(255),
            course_id INT,
            section_url VARCHAR(255),
            FOREIGN KEY (course_id) REFERENCES COURSE(id) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $table_video = "CREATE TABLE VIDEO(
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            video_url VARCHAR(255),
            section_id INT,
            FOREIGN KEY (section_id) REFERENCES SECTION(id) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        if (!$this->conn->query($table_user)) {
            throw new \Exception("Cannot create user table" . $this->conn->error);
        }

        if (!$this->conn->query($table_courses)) {
            throw new \Exception("Cannot create course table" . $this->conn->error);
        }

        if (!$this->conn->query($table_section)) {
            throw new \Exception("Cannot create section table" . $this->conn->error);
        }

        if (!$this->conn->query($table_video)) {
            throw new \Exception("Cannot create video table" . $this->conn->error);
        }
        $this->createAdminUser();
    }

    // function to create admin user 
    public function createAdminUser()
    {
        echo $this->adminpass;
        $options = [
            'cost' => 10,
        ];
        $hashed_password = password_hash($this->adminpass, PASSWORD_BCRYPT, $options);
        $admin_user = "INSERT INTO USER (username, email, password, isAdmin) VALUES('$this->adminuser','$this->email','$hashed_password','yes')";
        if (!$this->conn->query($admin_user)) {
            throw new \Exception("Cannot create admin user" . $this->conn->error);
        }
        $this->closeConnection();
    }
}
