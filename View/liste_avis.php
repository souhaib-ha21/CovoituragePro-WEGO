<?php
include("../Connexion/connexion.php");
include_once("../Controller/ControlReview.php");
require_once("../Model/Review.php");

// Vérification de la connexion et du rôle
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Covoiturage by Souhaib</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootswatch Theme - Darkly -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar Admin -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#"> Admin  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
          <a class="nav-link" href="menu_admin.php">Acceuil </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="liste_trajets.php">Liste des Trajets</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="liste_clients.php">Liste des clients</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="liste_avis.php">Liste des Avis</a>
        </li>



      </ul>
      <div class="d-flex">
      <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
      </div>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">Liste des Avis</h2>

    <?php 
    $avis=Review::getAllReviewsWithUsers();
    if (count($avis) > 0): ?>
        <?php foreach ($avis as $a): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($a['user_id']) ?>  <?= $a['rating'] ?>/5</h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($a['comment'])) ?></p>
                    <small class="text-muted">Posté le <?= date('d/m/Y H:i', strtotime($a['created_at'])) ?></small>
                    <div class="mt-2">
    <a href="../Controller/ControlReview.php?id_trajet=<?= $a['id_trajet'] ?>&user_id=<?= $a['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression de cet avis ?');">
         Supprimer
      </a>
      <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">L'avis a été supprimé avec succès.</div>
<?php endif; ?>

          </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">Aucun avis à afficher.</div>
    <?php endif; ?>
</div>

</body>
</html>
