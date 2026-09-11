<?php
include 'db.php';
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$service = $_POST['service'];
$message = $_POST['message'];
$source_page = $_POST['source_page'];

$conn->query("INSERT INTO requests (name, phone, email, service, message, source_page) VALUES ('$name', '$phone', '$email', '$service', '$message', '$source_page')");

echo "success";
?>