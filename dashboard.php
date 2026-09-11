<?php
session_start();
if(!isset($_SESSION['user'])){ header("Location: login.php"); exit(); }
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title>
<style>
body{font-family:Arial;background:#f2f2f2;margin:0;padding:20px}
.box{background:#fff;padding:20px;border-radius:10px;overflow-x:auto}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{border:1px solid #ccc;padding:10px;text-align:left}
th{background:#0a2a6b;color:white}
a.btn{padding:8px 12px;background:#ff6600;color:#fff;text-decoration:none;border-radius:5px;margin-right:5px}
a.del{background:red}
</style>
</head>
<body>
<div class="box">
<h1>Welcome <?php echo $_SESSION['user']; ?>!</h1>
<a class="btn" href="index.html">Home Page</a>
<a class="btn" href="logout.php">Logout</a>

<h2>Customer Requests</h2>
<table>
<tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Service</th><th>Message</th><th>Source</th><th>Action</th></tr>
<?php
$result = $conn->query("SELECT * FROM requests ORDER BY id DESC");
while($row = $result->fetch_assoc()){
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['phone']}</td>
    <td>{$row['email']}</td>
    <td>{$row['service']}</td>
    <td>{$row['message']}</td>
    <td>{$row['source_page']}</td>
    <td><a class='btn del' href='delete.php?id={$row['id']}' onclick='return confirm(\"Delete?\")'>Delete</a></td>
    </tr>";
}
?>
</table>
</div>
</body>
</html>