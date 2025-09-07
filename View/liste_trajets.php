<?php
include('../Connexion/connexion.php');
include "../Model/Trajet.php";


session_start();
// Vérification de la connexion et du rôle
if (!isset($_SESSION['email']) ){
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<!-- Navbar Admin -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#"> Admin Panel</a>
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
        <li class="nav-item">
          <a class="nav-link" href="messagerie.php">Messagerie</a>
        </li>

      </ul>
      <div class="d-flex">
        <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
        
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">Liste des Trajets Disponibles</h2>

    <?php if ($trajets=Trajet::getAllTrajets()): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle shadow">
                <thead class="table-dark">
                    <tr>
                        <th>Conducteur</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Lieu de départ</th>
                        <th>Lieu d'arrivée</th>
                        <th>Places dispo.</th>
                        <th>Montant</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trajets as $trajet): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($trajet['driver_email']); ?></td>
                            <td><?php echo htmlspecialchars($trajet['date']); ?></td>
                            <td><?php echo htmlspecialchars($trajet['heure']); ?></td>
                            <td><?php echo htmlspecialchars($trajet['depart']); ?></td>
                            <td><?php echo htmlspecialchars($trajet['arrivee']); ?></td>
                            <td><?php echo htmlspecialchars($trajet['available_seats']); ?></td>
                            <td><?php echo htmlspecialchars($trajet['price']); ?> TND</td>
                            <td class="text-center">
                                <form action="../Controller/ControlLstTrj.php" method="Get">
                                <input type="hidden" name="idtrj" value="<?= $trajet['id'] ?>">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="submit">Annuler</button>                                </div>
                    </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            Aucun trajet disponible pour le moment.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
