<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "traveldb"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = $_POST['note'];
    $date_added = $_POST['date_added'];

   
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }

        $photoPath = $uploadDir . basename($_FILES['photo']['name']);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
          
            $stmt = $conn->prepare("INSERT INTO memories (photo, note, date_added) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $photoPath, $note, $date_added);

            if ($stmt->execute()) {
                echo "Memory saved successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error saving photo to the server.";
        }
    } else {
        echo "Error uploading photo.";
    }
}

$conn->close();
?>
