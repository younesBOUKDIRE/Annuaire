<?php
require '../config/database.php';

$error = '';

if ($_POST) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'ADMIN') {
            header("Location: /annuaire/admin/dashboard.php");
        } else {
            header("Location: /annuaire/public/index.php");
        }
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>

    body{
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg,#4facfe,#00f2fe);
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .login-card{
        background:white;
        padding:40px;
        border-radius:10px;
        width:320px;
        box-shadow:0 10px 25px rgba(0,0,0,0.2);
    }

    .login-card h2{
        text-align:center;
        margin-bottom:25px;
    }

    .login-card input{
        width:100%;
        padding:10px;
        margin:8px 0;
        border-radius:5px;
        border:1px solid #ccc;
    }

    .login-card button{
        width:100%;
        padding:10px;
        border:none;
        background:#4facfe;
        color:white;
        font-weight:bold;
        border-radius:5px;
        cursor:pointer;
        margin-top:10px;
    }

    .login-card button:hover{
        background:#2f80ed;
    }

    .error{
        color:red;
        text-align:center;
        margin-bottom:10px;
    }

</style>

</head>

<body>

    <div class="login-card">

        <h2>Login</h2>

        <?php if($error): ?>
        <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="post">

            <input name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>

        </form>
        <p style="text-align:center;margin-top:10px;">
            No account? <a href="register.php">Register</a>
        </p>

    </div>

</body>
</html>