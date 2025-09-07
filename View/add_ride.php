<?php
include_once "../Connexion/connexion.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer un Trajet</title>
    <!-- Lien vers Bootstrap pour un design responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

<div class="container mt-5">
    <h2>Proposer un Trajet</h2>

    <form method="POST" action="../Controller/ControlAddTrajet.php">
        <div class="mb-3">
            <label for="date" class="form-label">Date du trajet</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="mb-3">
            <label for="heure" class="form-label">Heure de départ</label>
            <input type="time" class="form-control" id="heure" name="heure" required>
        </div>

        <div class="mb-3">
            <label for="lieu_depart" class="form-label">Lieu de départ</label>
            <input type="text" class="form-control" id="_depart" name="depart" required>
        </div>

        <div class="mb-3">
            <label for="lieu_arrivee" class="form-label">Lieu d'arrivée</label>
            <input type="text" class="form-control" id="arrivee" name="arrivee" required>
        </div>

        <div class="mb-3">
            <label for="places_disponibles" class="form-label">Nombre de places disponibles</label>
            <input type="number" class="form-control" id="available_seats" name="available_seats" required>
        </div>
        <div class="mb-3">
    <label for="price" class="form-label">Prix du trajet (en TND)</label>
    <input type="number" class="form-control" id="price" name="price" required>
</div>

        <button type="submit" class="btn btn-primary">Proposer le trajet</button>
    </form>
</div>

<!-- Lien vers Bootstrap JS pour les fonctionnalités interactives -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


