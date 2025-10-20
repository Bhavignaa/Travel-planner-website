<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    file_put_contents("debug_log.txt", "Connection failed: " . $conn->connect_error . "\n", FILE_APPEND);
    die("Connection failed: " . $conn->connect_error);
}


file_put_contents("debug_log.txt", "POST Data: " . print_r($_POST, true), FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $firstName = $_POST['traveller_first_name'] ?? null;
    $lastName = $_POST['traveller_last_name'] ?? null;
    $dob = $_POST['traveller_dob'] ?? null;
    $gender = $_POST['traveller_gender'] ?? null;
    $passport = $_POST['traveller_passport'] ?? null;
    $from = $_POST['from'] ?? null;
    $fromDate = $_POST['from-date'] ?? null;
    $to = $_POST['to'] ?? null;
    $toDate = $_POST['to-date'] ?? null;
    $email = $_POST['email'] ?? null;
    $mobileCode = $_POST['mobile_code'] ?? null;
    $mobile = $_POST['mobile'] ?? null;
    $city = $_POST['city'] ?? null;
    $gstState = $_POST['gst_state'] ?? null;
    $address = $_POST['address'] ?? null;
    $specialRequest = $_POST['special_request'] ?? null;


    if (!$firstName || !$lastName || !$dob || !$gender || !$passport || !$from || !$fromDate || !$to || !$toDate || !$email || !$mobileCode || !$mobile || !$gstState) {
        file_put_contents("debug_log.txt", "Validation failed: Required fields are missing.\n", FILE_APPEND);
        die("Required fields are missing.");
    }

    file_put_contents("debug_log.txt", "Validated Data: " . print_r([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'dob' => $dob,
        'gender' => $gender,
        'passport' => $passport,
        'from' => $from,
        'fromDate' => $fromDate,
        'to' => $to,
        'toDate' => $toDate,
        'email' => $email,
        'mobileCode' => $mobileCode,
        'mobile' => $mobile,
        'city' => $city,
        'gstState' => $gstState,
        'address' => $address,
        'specialRequest' => $specialRequest
    ], true), FILE_APPEND);

    $stmt = $conn->prepare("INSERT INTO travellers (
        first_name, last_name, dob, gender, passport, 
        from_location, from_date, to_location, to_date, 
        email, mobile_code, mobile, city, gst_state, 
        address, special_request
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        file_put_contents("debug_log.txt", "Prepare failed: " . $conn->error . "\n", FILE_APPEND);
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssssssss",
        $firstName, $lastName, $dob, $gender, $passport,
        $from, $fromDate, $to, $toDate,
        $email, $mobileCode, $mobile, $city, $gstState,
        $address, $specialRequest
    );

    if (!$stmt->execute()) {
        file_put_contents("debug_log.txt", "Execute failed: " . $stmt->error . "\n", FILE_APPEND);
        die("Execute failed: " . $stmt->error);
    }

    file_put_contents("debug_log.txt", "Traveller saved successfully.\n", FILE_APPEND);

    $stmt->close();
    $conn->close();

    header("Location: payments.html");
    exit();

} else {
    file_put_contents("debug_log.txt", "Invalid request method.\n", FILE_APPEND);
    die("Invalid request method.");
}
?>
