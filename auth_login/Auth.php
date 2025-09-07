<?php
session_start();

class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register User
    public function register($email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO student (email, password) VALUES (:email, :password)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['email' => $email, 'password' => $hashed_password]);
    }

    public function login($email, $password) {
        $query = "SELECT * FROM student WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && password_verify($password, $student['password'])) {
            $_SESSION['user_email'] = $student['email'];
            return true;
        }
        return false;
    }

    // Check if user is logged in
    public function check() {
        return isset($_SESSION['user_email']);
    }

    // Get the current email
    public function student() {
        return $_SESSION['user_email'] ?? null;
    }

    // Logout student
    public function logout() {
        session_destroy();
    }
}
?>