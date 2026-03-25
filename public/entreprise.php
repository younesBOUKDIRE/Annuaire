<?php
require '../config/database.php';
include '../includes/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM entreprises WHERE id=?");
$stmt->execute([$id]);
$e = $stmt->fetch();

if (!$e) {
    echo "Entreprise not found";
    exit;
}
$avis = $pdo->prepare("
 SELECT a.*, u.name FROM avis a
 JOIN users u ON u.id = a.user_id
 WHERE entreprise_id=?
");
$avis->execute([$id]);
$reviews = $avis->fetchAll();
?>

<div class="card shadow mb-4">
  <?php if($e['logo']): ?>
    <img src="../uploads/logos/<?= $e['logo'] ?>" class="card-img-top"
         style="height:280px;object-fit:cover">
  <?php endif; ?>

  <div class="card-body">
    <h3>Partager cette entreprise</h3>

      <?php
      $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      ?>

      <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($currentUrl) ?>" alt="QR Code">

      <p>Scannez ce QR Code pour ouvrir cette page sur mobile.</p>
    <h2><?= $e['nom'] ?></h2>
    <p class="text-muted"><?= $e['categorie'] ?></p>

    <p><?= nl2br($e['description']) ?></p>

    <p><strong>Rating:</strong> <?= $e['note_moyenne'] ?> / 5 (<?= $e['nombre_avis'] ?> reviews)</p>

    <?php if($e['adresse']): ?>
      <p><strong>Address:</strong> <?= $e['adresse'] ?></p>
    <?php endif; ?>

    <?php if($e['telephone']): ?>
      <p><strong>Phone:</strong> <?= $e['telephone'] ?></p>
    <?php endif; ?>

    <?php if($e['email']): ?>
      <p><strong>Email:</strong> <?= $e['email'] ?></p>
    <?php endif; ?>

    <?php if($e['site_web']): ?>
      <p>
        <strong>Website:</strong>
        <a href="<?= $e['site_web'] ?>" target="_blank">
          <?= $e['site_web'] ?>
        </a>
      </p>
    <?php endif; ?>
  </div>
</div>

<iframe width="100%" height="300" class="mb-4"
src="https://maps.google.com/maps?q=<?= $e['latitude'] ?>,<?= $e['longitude'] ?>&output=embed">
</iframe>

<hr>

<h4>Reviews</h4>
<?php foreach($reviews as $r): ?>
<div class="border p-2 mb-2">
  <strong><?= $r['name'] ?></strong>
  ⭐ <?= $r['note'] ?>
  <p><?= $r['commentaire'] ?></p>
</div>
<?php endforeach; ?>

<?php if(isset($_SESSION['user'])): ?>
<form action="rate.php" method="post" class="mt-3">
  <input type="hidden" name="entreprise_id" value="<?= $id ?>">

  <select name="note" class="form-select mb-2">
    <option>5</option>
    <option>4</option>
    <option>3</option>
    <option>2</option>
    <option>1</option>
  </select>

  <textarea name="commentaire" class="form-control mb-2"
            placeholder="Your comment"></textarea>

  <button class="btn btn-success">Submit review</button>
</form>
<?php else: ?>
<p><a href="/annuaire/auth/login.php">Login</a> to rate</p>
<?php endif; ?>

