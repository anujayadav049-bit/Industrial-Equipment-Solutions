<?php
session_start();
// 1. Bina login ke delete nahi hoga
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'db.php';

// 2. ID sahi hai ya nahi check karo
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    die("Invalid ID");
}

$id = (int)$_GET['id'];

// 3. Secure Delete - SQL Injection se safe
$stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit();
?>