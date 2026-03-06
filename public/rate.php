<?php
require '../config/database.php';

$stmt = $pdo->prepare("
 INSERT INTO avis (entreprise_id,user_id,note,commentaire)
 VALUES (?,?,?,?)
");
$stmt->execute([
 $_POST['entreprise_id'],
 $_SESSION['user']['id'],
 $_POST['note'],
 $_POST['commentaire']
]);

$pdo->query("
 UPDATE entreprises SET
 note_moyenne = (
   SELECT AVG(note) FROM avis WHERE entreprise_id={$_POST['entreprise_id']}
 ),
 nombre_avis = (
   SELECT COUNT(*) FROM avis WHERE entreprise_id={$_POST['entreprise_id']}
 )
 WHERE id={$_POST['entreprise_id']}
");

header("Location: entreprise.php?id=".$_POST['entreprise_id']);
