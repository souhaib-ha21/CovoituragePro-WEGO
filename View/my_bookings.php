<?php
include_once ("../Model/Booking.php");
include_once ("../Connexion/connexion.php");

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations </title>
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

                <li class="nav-item">
                    <a class="nav-link text-light" href="review_ride.php"> Avis</a>
                </li>
            </ul>

            <span class="navbar-text me-3 text-white">
                Bonjour, <?= htmlspecialchars($_SESSION['email']) ?>
            </span>
            <a class="btn btn-outline-light" href="logout.php">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Mes Réservations</h2>

    <?php 
    $bookings = Booking::getBookingsByUser($email);
    if ($bookings): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Départ</th>
                    <th>Arrivée</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Prix (TND)</th>
                    <th>Places restantes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                    <tr>
                        <td><?= htmlspecialchars($b['depart']) ?></td>
                        <td><?= htmlspecialchars($b['arrivee']) ?></td>
                        <td><?= htmlspecialchars($b['date']) ?></td>
                        <td><?= htmlspecialchars($b['heure']) ?></td>
                        <td><?= htmlspecialchars($b['price']) ?></td>
                        <td><?= htmlspecialchars($b['available_seats']) ?></td>
                        <td>
                         <a href="deleteBooking.php?user_id=<?= urlencode($_SESSION['email']) ?> &trajet_id=<?= $b['trajet_id'] ?>"
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Annuler cette réservation ?')">
                               Annuler
                                </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Vous n'avez effectué aucune réservation pour le moment.</div>
    <?php endif ?>
</div>

</body>
</html>
