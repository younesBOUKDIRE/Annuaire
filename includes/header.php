<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Annuaire</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/annuaire/public/index.php">Annuaire</a>

    <div class="ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <?php if($_SESSION['user']['role'] === 'USER'): ?>
            <a href="/annuaire/public/index.php" class="btn btn-outline-light btn-sm me-2">Acceuil</a>
            <?php endif; ?>
            <?php if($_SESSION['user']['role'] === 'ADMIN'): ?>
            <a href="/annuaire/admin/dashboard.php" class="btn btn-warning btn-sm me-2">
              Admin
            </a>
          <?php endif; ?>
        <?php endif; ?>
        
      <?php if(isset($_SESSION['user'])): ?>

        <span class="text-white me-2">
          <?= $_SESSION['user']['name'] ?>
        </span>

        <a href="/annuaire/auth/logout.php" class="btn btn-danger btn-sm">
          Logout
        </a>
      <?php else: ?>
        <a href="/annuaire/auth/login.php" class="btn btn-outline-light btn-sm me-2">
          Login
        </a>
        <a href="/annuaire/auth/register.php" class="btn btn-success btn-sm">
          Register
        </a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container mt-4">



