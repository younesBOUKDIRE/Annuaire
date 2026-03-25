<?php
require '../config/database.php';
require '../includes/admin_check.php';
include '../includes/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM entreprises WHERE id=?");
$stmt->execute([$id]);
$e = $stmt->fetch();
?>

<h2>Edit Entreprise</h2>

<form action="update_entreprise.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $e['id'] ?>">
<input type="hidden" name="old_logo" value="<?= $e['logo'] ?>">

<label>Nom</label>
<input class="form-control mb-2" name="nom" value="<?= $e['nom'] ?>">

<label>Catégorie</label>
<input class="form-control mb-2" name="categorie" value="<?= $e['categorie'] ?>">

<label>Description</label>
<textarea class="form-control mb-2" name="description"><?= $e['description'] ?></textarea>

<label>Adresse</label>
<textarea class="form-control mb-2" name="adresse"><?= $e['adresse'] ?></textarea>

<label>Téléphone</label>
<input class="form-control mb-2" name="telephone" value="<?= $e['telephone'] ?>">

<label>Email</label>
<input class="form-control mb-2" name="email" value="<?= $e['email'] ?>">

<label>Site Web</label>
<input class="form-control mb-2" name="site_web" value="<?= $e['site_web'] ?>">

<label>Logo</label>
<input type="file" name="logo" class="form-control mb-2">

<!-- Hidden lat/lng -->
<input type="hidden" id="lat" name="latitude" value="<?= $e['latitude'] ?>">
<input type="hidden" id="lng" name="longitude" value="<?= $e['longitude'] ?>">

<h5>Modifier la position</h5>
<div id="map" style="height:300px;"></div>

<button class="btn btn-primary mt-3">Update</button>
</form>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKk9_vsrjRE0HQg0TJUBfqQcWPEUq1XJw"></script>
<script>

let position = {
    lat: parseFloat(<?= $e['latitude'] ?>),
    lng: parseFloat(<?= $e['longitude'] ?>)
};

const map = new google.maps.Map(document.getElementById("map"), {
    center: position,
    zoom: 10
});

let marker = new google.maps.Marker({
    position: position,
    map: map
});

map.addListener("click", e => {
    marker.setPosition(e.latLng);

    document.getElementById("lat").value = e.latLng.lat();
    document.getElementById("lng").value = e.latLng.lng();
});

</script>