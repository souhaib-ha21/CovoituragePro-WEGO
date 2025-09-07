<?php
include('../Connexion/connexion.php');
include "../Model/User.php";
include "../Model/Trajet.php";




// Nombre de clients
$nb_clients = User::CountNbUser();

// Nombre de locations en cours
$nb_trajets = Trajet::CountNbTrajet();


 $nb_conducteurs = User::CountNbCond();
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
    <a class="navbar-brand fw-bold" href="#"> Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
          <a class="nav-link" href="#">Acceuil </a>
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
    <div class="text-center mb-4">
        <h2 class="text-light">Bienvenue sur le tableau de bord Admin</h2>
        <p class="text-muted">Gérez vos voitures, clients et réservations en toute simplicité</p>
    </div>

    <div class="row">
        <!-- Clients inscrits -->
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> Clients inscrits</h5>
                    <p class="card-text display-6"><?= $nb_clients ?></p>
                </div>
            </div>
        </div>

        <!-- Nos conducteurs -->
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> Nos conducteurs</h5>
                    <p class="card-text display-6"><?= $nb_conducteurs ?></p>
                </div>
            </div>
        </div>

        <!-- Trajets en cours -->
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"> Trajets en cours</h5>
                    <p class="card-text display-6"><?= $nb_trajets ?></p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Footer -->
<footer class="text-center text-muted mt-5 py-3 border-top border-secondary">
    &copy; WeGo  - Souhaib 
</footer>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>





