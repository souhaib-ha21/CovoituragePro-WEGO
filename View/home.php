<?php
include_once "../Model/Trajet.php";
include_once "../Connexion/connexion.php";

// Vérifie si l'utilisateur est connecté


session_start();
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
    <title>Accueil - WeGo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- navbar passager  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <!-- <img src="logo.png" alt="WeGo" width="30" height="30" class="d-inline-block align-text-top"> -->
            WeGo
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarUser">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-light" href="messagerieclient.php"> Messagerie </a> 
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light" href="my_bookings.php"> Mes Réservations</a>
                </li>


            </ul>

            <span class="navbar-text me-3 text-white">
                Bonjour, <?= htmlspecialchars($_SESSION['email']) ?>
            </span>
            <a class="btn btn-outline-light" href="logout.php">Déconnexion</a>
        </div>
    </div>
</nav>


<!-- navbar passager  -->

<div class="container mt-5">
    <h2 class="mb-4">Liste des trajets disponibles</h2>

    <?php 
    if ($trajets=Trajet::getAllTrajets()): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Départ</th>
                    <th>Destination</th>
                    <th>Date / Heure</th>
                    <th>Conducteur</th>
                    <th>Prix (TND)</th>
                    <th>Places disponibles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($trajets as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['depart']) ?></td>
                    <td><?= htmlspecialchars($row['arrivee']) ?></td>
                    <td><?= htmlspecialchars($row['date']) . ' / ' . htmlspecialchars($row['heure']) ?></td>
                    <td><?= htmlspecialchars($row['driver_email']) ?></td>
                    <td><?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['available_seats']) ?></td>
                    <td>



                        <a href="trajet_map.php?trajet_id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Voir Trajet</a>
                        <a href="book_ride.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Réserver</a>
                        <a href="review_ride.php?id_trajet=<?= $row['id'] ?>" class="btn btn-light btn-sm">Donner Avis</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aucun trajet disponible pour le moment.</div>
    <?php endif; ?>
</div>

</body>
</html>
