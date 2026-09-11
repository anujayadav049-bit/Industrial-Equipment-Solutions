<?php
session_start();
include 'db.php';
$email = $_POST['email'];
$pass = $_POST['password'];
$res = $conn->query("SELECT * FROM users WHERE email='$email'");
if($res->num_rows > 0){
  $row = $res->fetch_assoc();
  if(password_verify($pass, $row['password'])){
    $_SESSION['user'] = $row['name'];
    header("Location: dashboard.php");
    exit();
  }
}
echo "Galat password! <a href='login.php'>Wapas jao</a>";
?>