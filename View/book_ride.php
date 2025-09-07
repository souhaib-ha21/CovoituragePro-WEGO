<?php
session_start();
include '../Connexion/connexion.php'; 
 include '../Model/Trajet.php';
 include '../Model/User.php';


if (!isset($_GET['id'])) {
    header("Location: ../View/home.php");
    exit;
}

$trajet_id = intval($_GET['id']);
$trajets=Trajet::getTrajetById($trajet_id);
$user=User::getUserByMail($trajets['driver_email']);
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver un trajet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Confirmer la réservation</h2>
    <div class="card shadow p-4">
    <form method="post" class="mt-4" action="../Controller/ControlBookRide.php">

        <h5><strong>Départ :</strong> <?= htmlspecialchars($trajets['depart']) ?></h5>
        <h5><strong>Destination :</strong> <?= htmlspecialchars($trajets['arrivee']) ?></h5>
        <h5><strong>Date/Heure :</strong> <?= date('d/m/Y ', strtotime($trajets['date'])) ?></h5>
        <h5><strong>Date/Heure :</strong> <?= date(' H:i', strtotime($trajets['heure'])) ?></h5>
        <h5><strong>Conducteur :</strong> <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h5>
        <h5><strong>Prix :</strong> <?= number_format($trajets['price'], 2) ?> DT</h5>
        <h5><strong>Places disponibles :</strong> <?= $trajets['available_seats'] ?></h5>

<!-- Hidden fields to send data -->
<input type="hidden" name="id" value="<?= $trajets['id'] ?>">
<input type="hidden" name="depart" value="<?= htmlspecialchars($trajets['depart']) ?>">
<input type="hidden" name="arrivee" value="<?= htmlspecialchars($trajets['arrivee']) ?>">
<input type="hidden" name="date" value="<?= $trajets['date'] ?>">
<input type="hidden" name="heure" value="<?= $trajets['heure'] ?>">
<input type="hidden" name="driver_name" value="<?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>">
<input type="hidden" name="price" value="<?= $trajets['price'] ?>">
<input type="hidden" name="available_seats" value="<?= $trajets['available_seats'] ?>">

<button type="submit" class="btn btn-success w-100">Réserver maintenant</button>
</form>

        <a href="home.php" class="btn btn-secondary mt-3">Retour</a>
    </div>
</div>
</body>
</html>
