<?php
session_start();
include_once "../Model/Trajet.php";
include ("../Connexion/connexion.php");



$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil Conducteur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      min-height: 100vh;
    }
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .table-container {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<!-- menu_user.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home_conducteur.php">WeGo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="add_ride.php">Proposer un trajet</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="messageriecond.php">Messagerie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ModeFrequent.php">Mode Frequent </a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenu principal -->
<div class="container mt-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold text-primary shadow-sm">Bienvenue dans votre tableau de bord conducteur</h2>
    <p class="lead text-muted">Consultez vos trajets, messages et paramètres depuis ce tableau de bord.</p>
  </div>

  <div class="card shadow p-4">
    <h4 class="mb-3 text-success"><i class="bi bi-car-front-fill me-2"></i>Vos trajets à venir</h4>
    
    <div class="table-responsive">
      <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th>#</th>
            <th>Depart </th>
            <th>Destination</th>
            <th>Date Heure</th>
            <th>Heure</th>
            <th>Places disponible</th>
            <th>Montant </th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="text-center">
  <?php
  if ($result_trajets=Trajet::getTrajetByCondMail($email)) {
      foreach ($result_trajets as $trajet) {
          // Générer l'état du trajet en fonction du statut
          $status_badge = '';
          switch ($trajet['status']) {
              case 0:
                  $status_badge = "<span class='badge bg-success'>Disponible</span>";
                  break;
              case 1:
                  $status_badge = "<span class='badge bg-warning text-dark'>Complet</span>";
                  break;
              case 2:
                  $status_badge = "<span class='badge bg-secondary'>Réalisé</span>";
                  break;
              default:
                  $status_badge = "<span class='badge bg-dark'>Annulé</span>";
          }

          echo "<tr>
          <td class='text-center'>{$trajet['id']}</td>
          <td>{$trajet['depart']}</td>
          <td>{$trajet['arrivee']}</td>
          <td>{$trajet['date']}</td>
          <td>{$trajet['heure']}</td>
          <td class='text-center'>{$trajet['available_seats']}</td>
          <td>{$trajet['price']} DT</td>
          <td>{$status_badge}</td>
          <td>
            <div class='d-grid gap-2'>
              <a href='afficher_reservations.php?id={$trajet['id']}' class='btn btn-sm btn-outline-primary'>
                <i class='bi bi-people-fill'></i> Réservations
              </a>

              <a href='../Controller/annuler_trajet.php?id={$trajet['id']}'
                 class='btn btn-sm btn-outline-danger'
                 onclick='return confirm(\"Voulez-vous vraiment annuler ce trajet ?\")'>
                <i class='bi bi-x-circle'></i> Annuler Trajet
              </a>

              <a href='ModeFrequent.php?id={$trajet['id']}'
                 class='btn btn-sm btn-outline-success'
                 onclick='return confirm(\"Ajouter ce trajet comme fréquent ?\")'>
                <i class='bi bi-arrow-repeat'></i> Ajouter Fréquent
              </a>
            </div>
          </td>
        </tr>";
}
} else {
echo "<tr><td colspan='9' class='text-center'>Aucun trajet trouvé.</td></tr>";
}
?>
</tbody>

      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
