<?php
session_start();
include 'db.php';

// Session start
if (!isset($_SESSION['login_attempt'])) {
    $_SESSION['login_attempt'] = 0;
    $_SESSION['login_time'] = 0;
}

// --- 1. BLOCK CHECK (3 baar galat ke baad 5 min block) ---
if ($_SESSION['login_attempt'] >= 3) {
    $timeLeft = 300 - (time() - $_SESSION['login_time']);
    if ($timeLeft > 0) {
        $min = ceil($timeLeft / 60);
        // Block Page
        ?>
        <!DOCTYPE html>
        <html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Blocked</title>
        <style>body{margin:0;font-family:Segoe UI,sans-serif;background:#f4f6fb;display:flex;justify-content:center;align-items:center;height:100vh}.box{background:#fff;padding:35px 30px;border-radius:16px;box-shadow:0 15px 40px rgba(0,0,0,.1);text-align:center;max-width:380px;width:90%;border-top:5px solid #0e2f7a}h2{color:#0e2f7a;margin:0 0 10px}p{color:#555;font-size:14px;line-height:1.6}a{background:#0e2f7a;color:#ffcc00;padding:11px 22px;border-radius:8px;text-decoration:none;font-weight:700;display:inline-block;margin-top:10px}</style>
        </head><body><div class="box"><h2>Login Blocked</h2><p>Incorrect password entered 3 times.<br>For security, login is blocked for <b><?php echo $min; ?> minute(s)</b>.</p><a href="auth.php">Try Again After <?php echo $min; ?> Minutes</a></div></body></html>
        <?php
        exit();
    } else {
        // 5 min ho gaye, reset kar do
        $_SESSION['login_attempt'] = 0;
    }
}

$msg = "";

// --- 2. LOGIN LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['login_attempt'] = 0;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        }
    }

    // Galat hai to attempt badhao
    $_SESSION['login_attempt'] += 1;
    $_SESSION['login_time'] = time();
    $left = 3 - $_SESSION['login_attempt'];

    if ($left <= 0) {
        header("Location: auth.php");
        exit();
    } else {
        $msg = "Wrong Email or Password! $left attempt(s) left.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Electrical Website</title>
<style>
body{margin:0;font-family:'Segoe UI',sans-serif;background:#f4f6fb;display:flex;justify-content:center;align-items:center;height:100vh}
.card{background:#fff;width:370px;padding:30px;border-radius:18px;box-shadow:0 15px 40px rgba(0,0,0,.1);border-top:5px solid #0e2f7a}
h2{text-align:center;color:#0e2f7a;margin:0 0 20px}
input{width:100%;padding:12px 14px;margin:8px 0;border:1px solid #ddd;border-radius:10px;box-sizing:border-box;font-size:14px}
button{width:100%;padding:12px;background:#0e2f7a;color:#ffcc00;border:none;border-radius:10px;font-weight:800;font-size:15px;cursor:pointer;margin-top:12px}
.alert{background:#ffe5e5;color:#d93025;padding:10px;border-radius:10px;text-align:center;font-size:13px;margin-bottom:12px}
small{display:block;text-align:center;color:#888;margin-top:15px}
</style>
</head>
<body>
<div class="card">
<h2>Admin Login</h2>
<?php if($msg){ echo "<div class='alert'>$msg</div>"; } ?>
<form method="POST" action="auth.php">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
<small>3 wrong attempts = 5 min block</small>
</div>
</body>
</html>