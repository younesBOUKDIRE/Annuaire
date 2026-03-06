<?php
require '../config/database.php';

if ($_POST) {
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        "INSERT INTO users (name,email,password) VALUES (?,?,?)"
    );
    $stmt->execute([$_POST['name'], $_POST['email'], $pass]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>

body{
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#4facfe,#00f2fe);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.register-card{
    background:white;
    padding:40px;
    border-radius:10px;
    width:320px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.register-card h2{
    text-align:center;
    margin-bottom:25px;
}

.register-card input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:5px;
    border:1px solid #ccc;
}

.register-card button{
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

.register-card button:hover{
    background:#2f80ed;
}

.login-link{
    text-align:center;
    margin-top:15px;
}

.login-link a{
    text-decoration:none;
    color:#4facfe;
    font-weight:bold;
}

</style>

</head>

<body>

    <div class="register-card">

        <h2>Create Account</h2>

        <form method="post">

            <input name="name" placeholder="Name" required>

            <input name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Register</button>

        </form>

        <div class="login-link">
        Already have an account? <a href="login.php">Login</a>
        </div>

    </div>

</body>
</html>