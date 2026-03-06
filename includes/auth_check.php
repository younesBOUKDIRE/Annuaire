<?php
if (!isset($_SESSION['user'])) {
    header("Location: /annuaire/auth/login.php");
    exit;
}
