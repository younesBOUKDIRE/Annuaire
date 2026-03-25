<?php
require '../config/database.php';
require '../includes/admin_check.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM entreprises WHERE id=?");
$stmt->execute([$id]);

header("Location: dashboard.php");