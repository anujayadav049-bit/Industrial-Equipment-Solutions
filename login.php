<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Login - Electrical Website</title>
<style>
body{font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;background:#f2f2f2;margin:0}
.box{background:#fff;padding:30px;border-radius:10px;width:320px;box-shadow:0 0 10px #aaa}
input{width:100%;padding:10px;margin:8px 0;box-sizing:border-box}
button{width:100%;padding:10px;background:#ff6600;color:#fff;border:none;cursor:pointer;font-size:16px;border-radius:5px}
.pass-wrap{position:relative}
.eye{position:absolute;right:10px;top:18px;cursor:pointer;font-size:14px}
</style>
</head>
<body>
<div class="box">
<h2>Admin Login</h2>
<form method="POST" action="auth.php" autocomplete="off">
<input type="email" name="email" placeholder="Email" required autocomplete="off">

<div class="pass-wrap">
<input type="password" id="password" name="password" placeholder="Password" required autocomplete="new-password">
<span class="eye" onclick="togglePass()">👁️</span>
</div>

<button type="submit">Login</button>
</form>
</div>

<script>
function togglePass(){
  let p = document.getElementById('password');
  p.type = p.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>