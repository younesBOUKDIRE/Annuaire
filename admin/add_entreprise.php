<?php
require '../config/database.php';
require '../includes/admin_check.php';
include '../includes/header.php';
?>

<h2 class="mb-3">Add Entreprise</h2>

<form action="save_entreprise.php" method="post" enctype="multipart/form-data" class="card p-3 shadow">

  <input class="form-control mb-2" name="nom" placeholder="Entreprise name" required>

  <input class="form-control mb-2" name="categorie" placeholder="Category" required>

  <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>

  <textarea class="form-control mb-2" name="adresse" placeholder="Address"></textarea>

  <input class="form-control mb-2" name="telephone" placeholder="Phone">

  <input class="form-control mb-2" name="email" type="email" placeholder="Email">

  <input class="form-control mb-2" name="site_web" placeholder="Website (https://...)">

  <label class="mt-2">Entreprise logo</label>
  <input type="file" name="logo" class="form-control mb-3">

  <input type="hidden" name="latitude" id="lat">
  <input type="hidden" name="longitude" id="lng">

  <button class="btn btn-success">Save entreprise</button>
</form>

<h5 class="mt-4">Click on map to set location</h5>
<div id="map" style="height:350px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKk9_vsrjRE0HQg0TJUBfqQcWPEUq1XJw"></script>
<script>
let marker;
const map = new google.maps.Map(document.getElementById("map"), {
  center:{lat:33.5,lng:-7.6},
  zoom:6
});

map.addListener("click", e => {
  document.getElementById("lat").value = e.latLng.lat();
  document.getElementById("lng").value = e.latLng.lng();

  if(marker) marker.setMap(null);
  marker = new google.maps.Marker({
    position: e.latLng,
    map: map
  });
});
</script>
