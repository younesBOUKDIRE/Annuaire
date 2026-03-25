<?php
require '../config/database.php';
require '../includes/admin_check.php';
include '../includes/header.php';
?>

<div class="container my-5">

  <h2 class="mb-4">Add New Entreprise</h2>

  <form action="save_entreprise.php" method="post" enctype="multipart/form-data" class="card p-4 shadow-sm">

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <input type="text" class="form-control" name="nom" placeholder="Entreprise Name" required>
      </div>
      <div class="col-md-6">
        <input type="text" class="form-control" name="categorie" placeholder="Category" required>
      </div>
    </div>

    <div class="mb-3">
      <textarea class="form-control" name="description" placeholder="Description" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <textarea class="form-control" name="adresse" placeholder="Address" rows="2"></textarea>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-4">
        <input type="text" class="form-control" name="telephone" placeholder="Phone">
      </div>
      <div class="col-md-4">
        <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="col-md-4">
        <input type="url" class="form-control" name="site_web" placeholder="Website (https://...)">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Entreprise Logo</label>
      <input type="file" name="logo" class="form-control">
    </div>

    <input type="hidden" name="latitude" id="lat">
    <input type="hidden" name="longitude" id="lng">

    <div class="d-grid">
      <button type="submit" class="btn btn-success btn-lg">Save Entreprise</button>
    </div>
  </form>

  <h5 class="mt-5 mb-3">Click on the map to set the entreprise location</h5>
  <div id="map" style="height:400px;" class="rounded shadow-sm"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKk9_vsrjRE0HQg0TJUBfqQcWPEUq1XJw"></script>
<script>
  let marker;
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 33.5, lng: -7.6 },
    zoom: 6
  });

  map.addListener("click", e => {
    const latInput = document.getElementById("lat");
    const lngInput = document.getElementById("lng");

    latInput.value = e.latLng.lat();
    lngInput.value = e.latLng.lng();

    if(marker) marker.setMap(null);

    marker = new google.maps.Marker({
      position: e.latLng,
      map: map
    });
  });
</script>