<?php
require 'auth_check.php';

if ($_SESSION['user']['role'] !== 'ADMIN') {
    header("Location: /annuaire/public/index.php");
    exit;
}
