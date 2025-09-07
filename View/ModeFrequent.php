<?php
include_once "../Connexion/connexion.php";
include_once "../Model/Trajet.php";
if (!isset($_GET['id'])) {
  die("ID de trajet non fourni.");
}

$trajet_id = $_GET['id'];


?> 
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Trajet Récurrent</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS Dark Theme -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #ffffff;
    }
    .form-check-label {
      color: #ffffff;
    }
    .form-container {
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      margin-top: 50px;
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

<div class="container">
  <div class="form-container">
    <h3 class="mb-4">Proposer un trajet récurrent</h3>
    
    <form action="../Controller/ControlModeFrequent.php" method="POST">
      <h5>Jours de récurrence du trajet :</h5>
      <div class="mb-3">
      <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="lun" value="1" id="lun">
  <label class="form-check-label" for="lun">Lundi</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="mardi" value="1" id="mardi">
  <label class="form-check-label" for="mardi">Mardi</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="merc" value="1" id="merc">
  <label class="form-check-label" for="merc">Mercredi</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="jeudi" value="1" id="jeudi">
  <label class="form-check-label" for="jeudi">Jeudi</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="vend" value="1" id="vend">
  <label class="form-check-label" for="vend">Vendredi</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="sam" value="1" id="sam">
  <label class="form-check-label" for="sam">Samedi</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="dim" value="1" id="dim">
  <label class="form-check-label" for="dim">Dimanche</label>
</div>
<input type="hidden" name="idtrj" value="<?=$trajet_id?>">


      <!-- Autres champs ici selon besoin -->
      
      <button type="submit" class="btn btn-primary mt-3">Proposer le trajet</button>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
