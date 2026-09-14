<?php
session_start();
// Secure Login Check - sahi session name
if(!isset($_SESSION['user_id'])){ 
    header("Location: login.php"); 
    exit(); 
}
include 'db.php';

// User ka email nikal lo dashboard pe dikhane ke liye
$user_email = "Admin";
if(isset($_SESSION['email'])){
    $user_email = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard - Secure</title>
<style>
body{font-family:Arial;background:#f2f2f2;margin:0;padding:20px}
.box{background:#fff;padding:20px;border-radius:10px;overflow-x:auto}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{border:1px solid #ccc;padding:10px;text-align:left;font-size:14px}
th{background:#0a2a6b;color:white}
a.btn{padding:8px 12px;background:#ff6600;color:#fff;text-decoration:none;border-radius:5px;margin-right:5px}
a.del{background:red}
</style>
</head>
<body>
<div class="box">
<h1>Welcome <?php echo htmlspecialchars($user_email); ?>!</h1>
<a class="btn" href="index.html">Home Page</a>
<a class="btn" href="logout.php">Logout</a>

<h2>Customer Requests - Secure View</h2>
<table>
<tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Service</th><th>Message</th><th>Source</th><th>Action</th></tr>
<?php
$result = $conn->query("SELECT * FROM requests ORDER BY id DESC");
while($row = $result->fetch_assoc()){
    // htmlspecialchars se XSS attack block
    $id = (int)$row['id'];
    $name = htmlspecialchars($row['name']);
    $phone = htmlspecialchars($row['phone']);
    $email = htmlspecialchars($row['email']);
    $service = htmlspecialchars($row['service']);
    $message = htmlspecialchars($row['message']);
    $source = htmlspecialchars($row['source_page']);

    echo "<tr>
    <td>{$id}</td>
    <td>{$name}</td>
    <td>{$phone}</td>
    <td>{$email}</td>
    <td>{$service}</td>
    <td>{$message}</td>
    <td>{$source}</td>
    <td><a class='btn del' href='delete.php?id={$id}' onclick='return confirm(\"Delete?\")'>Delete</a></td>
    </tr>";
}
?>
</table>
</div>
</body>
</html>