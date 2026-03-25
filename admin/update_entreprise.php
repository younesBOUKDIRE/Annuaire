<?php
require '../config/database.php';
require '../includes/admin_check.php';

$logo = $_POST['old_logo'] ?? null;

if (!empty($_FILES['logo']['name'])) {
    $logo = time() . "_" . $_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], "../uploads/logos/$logo");
}

$stmt = $pdo->prepare("
UPDATE entreprises SET
nom=?,
categorie=?,
description=?,
adresse=?,
telephone=?,
email=?,
site_web=?,
latitude=?,
longitude=?,
logo=?
WHERE id=?
");

$stmt->execute([
 $_POST['nom'],
 $_POST['categorie'],
 $_POST['description'],
 $_POST['adresse'],
 $_POST['telephone'],
 $_POST['email'],
 $_POST['site_web'],
 $_POST['latitude'],
 $_POST['longitude'],
 $logo,
 $_POST['id']
]);

header("Location: dashboard.php");