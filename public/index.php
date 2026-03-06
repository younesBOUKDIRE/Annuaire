<?php
require '../config/database.php';
include '../includes/header.php';

$q = $_GET['q'] ?? '';

$stmt = $pdo->prepare("
 SELECT * FROM entreprises
 WHERE nom LIKE ? OR categorie LIKE ?
");
$stmt->execute(["%$q%", "%$q%"]);
$entreprises = $stmt->fetchAll();
?>

<form class="row mb-4">
  <div class="col-md-10">
    <input class="form-control" name="q" placeholder="Search by name or category">
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100">Search</button>
  </div>
</form>

<div id="map" style="height:400px;" class="mb-4"></div>

<div class="row">
<?php foreach($entreprises as $e): ?>
  <div class="col-md-4 mb-3">
    <div class="card h-100 shadow">
      <?php if($e['logo']): ?>
        <img src="../uploads/logos/<?= $e['logo'] ?>" class="card-img-top"
             style="height:180px;object-fit:cover">
      <?php endif; ?>
      <div class="card-body">
        <h5><?= $e['nom'] ?></h5>
        <p class="text-muted"><?= $e['categorie'] ?></p>
        <p>⭐ <?= $e['note_moyenne'] ?> (<?= $e['nombre_avis'] ?>)</p>
        <a href="entreprise.php?id=<?= $e['id'] ?>" class="btn btn-outline-primary btn-sm">
          View
        </a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKk9_vsrjRE0HQg0TJUBfqQcWPEUq1XJw"></script>
<script>
const data = <?= json_encode($entreprises) ?>;
const map = new google.maps.Map(document.getElementById("map"), {
  center:{lat:33.5,lng:-7.6}, zoom:6
});

data.forEach(e=>{
  if(e.latitude){
    new google.maps.Marker({
      position:{lat:parseFloat(e.latitude),lng:parseFloat(e.longitude)},
      map, title:e.nom
    });
  }
});
</script>
