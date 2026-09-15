<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid Request");
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$service = trim($_POST['service'] ?? 'General Enquiry');
$message = trim($_POST['message'] ?? '');
$source_page = trim($_POST['source_page'] ?? 'contact_page');

if (empty($name) || empty($phone) || strlen($phone) < 10) {
    echo "error: Name aur sahi Phone number bharo";
    exit();
}

// FIX: date column add kiya hai NOW() se
$stmt = $conn->prepare("INSERT INTO requests (name, phone, email, service, message, source_page, date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssss", $name, $phone, $email, $service, $message, $source_page);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "DB Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>