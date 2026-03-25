<?php
require '../config/database.php';
require '../includes/admin_check.php';
include '../includes/header.php';

$page = $_GET['page'] ?? 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$categorie = $_GET['categorie'] ?? '';

$countQuery = "SELECT COUNT(*) FROM entreprises";
$params = [];

if ($categorie) {
    $countQuery .= " WHERE categorie = ?";
    $params[] = $categorie;
}

$stmt = $pdo->prepare($countQuery);
$stmt->execute($params);
$total = $stmt->fetchColumn();
$pages = ceil($total / $limit);

$query = "SELECT * FROM entreprises";
if ($categorie) {
    $query .= " WHERE categorie = ?";
}

$query .= " LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$entreprises = $stmt->fetchAll();

$cats = $pdo->query("SELECT DISTINCT categorie FROM entreprises")->fetchAll();
?>

<h2 class="mb-3">Admin Dashboard</h2>

<a href="add_entreprise.php" class="btn btn-success mb-3">+ Add</a>

<form class="mb-3">
<select name="categorie" class="form-select w-25 d-inline">
    <option value="">All Categories</option>
    <?php foreach($cats as $c): ?>
        <option value="<?= $c['categorie'] ?>"
            <?= $categorie == $c['categorie'] ? 'selected' : '' ?>>
            <?= $c['categorie'] ?>
        </option>
    <?php endforeach; ?>
</select>

<button class="btn btn-primary">Filter</button>
</form>

<table class="table table-bordered">
<tr>
    <th>Nom</th>
    <th>Catégorie</th>
    <th>Actions</th>
</tr>

<?php foreach($entreprises as $e): ?>
<tr>
    <td><?= $e['nom'] ?></td>
    <td><?= $e['categorie'] ?></td>
    <td>
        <a href="edit_entreprise.php?id=<?= $e['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete_entreprise.php?id=<?= $e['id'] ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<nav>
<ul class="pagination">
<?php for($i=1;$i<=$pages;$i++): ?>
    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
        <a class="page-link"
           href="?page=<?= $i ?>&categorie=<?= $categorie ?>">
           <?= $i ?>
        </a>
    </li>
<?php endfor; ?>
</ul>
</nav>