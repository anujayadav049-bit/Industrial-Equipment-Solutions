<?php
session_start();
include 'db.php';

if (!isset($_SESSION['login_attempt'])) {
    $_SESSION['login_attempt'] = 0;
    $_SESSION['login_time'] = 0;
}

// Agar direct auth.php khola to login pe bhejo
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Block check
    if ($_SESSION['login_attempt'] >= 3) {
        $timeLeft = 300 - (time() - $_SESSION['login_time']);
        if ($timeLeft > 0) {
            // YAHI WO TIMER WALA PAGE HAI
            ?>
            <!DOCTYPE html>
            <html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Blocked</title>
            <style>body{margin:0;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;background:#f2f2f2}.box{background:#fff;padding:30px;border-radius:10px;width:320px;text-align:center;box-shadow:0 0 10px #aaa}#timer{font-size:48px;font-weight:800;color:red;margin:15px 0}</style>
            </head><body>
            <div class="box"><h2>Login Blocked</h2><p>incorrect password entered 3 time</p><div id="timer">05:00</div><p id="msg">login will be enabled after 5 mit</p></div>
            <script>
                let timeLeft = <?php echo $timeLeft; ?>;
                let el = document.getElementById("timer");
                function upd(){let m=Math.floor(timeLeft/60),s=timeLeft%60;el.innerHTML=(m<10?"0"+m:m)+":"+(s<10?"0"+s:s);}
                upd();
                setInterval(function(){
                    timeLeft--; upd();
                    if(timeLeft<=0){ window.location.href="login.php"; }
                },1000);
            </script>
            </body></html>
            <?php
            exit();
        } else {
            $_SESSION['login_attempt'] = 0;
            header("Location: login.php"); exit();
        }
    }
    header("Location: login.php");
    exit();
}

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
        header("Location: dashboard.php"); exit();
    }
}

$_SESSION['login_attempt'] += 1;
$_SESSION['login_time'] = time();

if ($_SESSION['login_attempt'] >= 3) {
    header("Location: auth.php"); 
    exit();
} else {
    $left = 3 - $_SESSION['login_attempt'];
    $_SESSION['error'] = "Wrong Password! $left attempt left.";
    header("Location: login.php"); 
    exit();
}
?>