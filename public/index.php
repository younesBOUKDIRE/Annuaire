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

<div class="container my-5">

    <form class="row g-3 mb-5" method="GET">
        <div class="col-md-10">
            <input type="text" class="form-control form-control-lg" name="q" placeholder="Search by name or category" value="<?= htmlspecialchars($q) ?>">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Search</button>
        </div>
    </form>

    <div id="map" style="height:450px;" class="mb-5 rounded shadow"></div>

    <div class="row g-4">
        <?php if(empty($entreprises)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">No results found.</div>
            </div>
        <?php else: ?>
            <?php foreach($entreprises as $e): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if($e['logo']): ?>
                            <img src="../uploads/logos/<?= $e['logo'] ?>" class="card-img-top" style="height:200px; object-fit:cover; border-bottom: 1px solid #ddd;">
                        <?php else: ?>
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:200px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($e['nom']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($e['categorie']) ?></p>
                            <p class="card-text">⭐ <?= $e['note_moyenne'] ?> (<?= $e['nombre_avis'] ?> reviews)</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="entreprise.php?id=<?= $e['id'] ?>" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKk9_vsrjRE0HQg0TJUBfqQcWPEUq1XJw"></script>
<script>
    const data = <?= json_encode($entreprises) ?>;
    const map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: 33.5, lng: -7.6},
        zoom: 6
    });

    data.forEach(e => {
        if(e.latitude && e.longitude){
             const position = {
                lat: parseFloat(e.latitude),
                lng: parseFloat(e.longitude)
            };

            const marker = new google.maps.Marker({
                position: position,
                map: map
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="font-weight:bold;">${e.nom}</div>`
            });

            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
            
        }
    });
</script>