<?php
include 'db.php';

// 1. Sirf POST request ko allow karo
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid Request");
}

// 2. Data ko saaf karo aur lo
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');
$source_page = trim($_POST['source_page'] ?? '');

// 3. Basic Validation (Khali to nahi hai?)
if (empty($name) || empty($phone) || strlen($phone) < 10) {
    echo "error: Name aur sahi Phone number bharo";
    exit();
}

// 4. SECURE QUERY - SQL Injection se 100% Safe (Prepared Statement)
$stmt = $conn->prepare("INSERT INTO requests (name, phone, email, service, message, source_page) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $phone, $email, $service, $message, $source_page);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>