<?php
class DB {
    private $conn;

    function __construct() {
        include_once('config.php');
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function executeQuery($query) {
        return $this->conn->query($query);
    }

    function registerUser($username, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";
        return $this->executeQuery($query);
    }

    function authenticateUser($username, $password) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->executeQuery($query);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return null;
    }
}
?>
