<?php
session_start();
$_SESSION = array();
session_destroy();
// Cache clear taaki back button se dashboard na khulee
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
header("Location: login.php");
exit();
?>