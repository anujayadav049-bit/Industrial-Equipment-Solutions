<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Login - Electrical Website</title>
<style>
body{font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;background:#f2f2f2;margin:0}
.box{background:#fff;padding:30px;border-radius:10px;width:300px;box-shadow:0 0 10px #aaa}
input{width:100%;padding:10px;margin:8px 0;box-sizing:border-box}
button{width:100%;padding:10px;background:#ff6600;color:#fff;border:none;cursor:pointer;font-size:16px}
</style>
</head>
<body>
<div class="box">
<h2>Login</h2>
<form method="POST" action="auth.php">
<input type="email" name="email" value="admin@gmail.com" required>
<input type="password" name="password" placeholder="password likho - password" required>
<button type="submit">Login</button>
</form>
<p style="font-size:12px">Email: admin@gmail.com<br>Pass: password</p>
</div>
</body>
</html>