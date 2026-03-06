<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Annuaire</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/annuaire/public/index.php">Annuaire</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
      aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <div class="ms-auto d-flex align-items-center gap-2">

        <?php if(isset($_SESSION['user'])): ?>
            <?php if($_SESSION['user']['role'] === 'USER'): ?>
              <a href="/annuaire/public/index.php" class="btn btn-outline-light btn-sm">
                Accueil
              </a>
            <?php endif; ?>

            <?php if($_SESSION['user']['role'] === 'ADMIN'): ?>
              <a href="/annuaire/admin/dashboard.php" class="btn btn-warning btn-sm fw-bold">
                Accueil
              </a>
            <?php endif; ?>

            <span class="text-white px-2">
              <?= htmlspecialchars($_SESSION['user']['name']) ?>
            </span>
            <a href="/annuaire/auth/logout.php" class="btn btn-danger btn-sm">
              Logout
            </a>

        <?php else: ?>
            <a href="/annuaire/auth/login.php" class="btn btn-outline-light btn-sm">
              Login
            </a>
            <a href="/annuaire/auth/register.php" class="btn btn-success btn-sm fw-bold">
              Register
            </a>
        <?php endif; ?>

      </div>
    </div>
  </div>
</nav>

<div class="container mt-5 pt-4">