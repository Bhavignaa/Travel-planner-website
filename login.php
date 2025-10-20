<?php
header('Content-Type: text/plain');

$host = 'localhost';
$username = 'root';
$password = ''; 
$dbname = 'travelDB';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'Database connection failed: ' . $conn->connect_error;
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

  
    error_log("Full Name: " . $fullname);
    error_log("Email: " . $email);
    error_log("Raw Password: " . $password);

    
    if (empty($fullname) || empty($email) || empty($password)) {
        echo 'All fields are required.';
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    error_log("Hashed Password: " . $hashedPassword);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo 'Signup successful!';
    } else {

        if ($conn->errno === 1062) {
            echo 'Email already exists.';
        } else {
            echo 'Signup failed. Please try again.';
        }
    }

    $stmt->close();
} else {
    echo 'Invalid request method.';
}

$conn->close();
?>
