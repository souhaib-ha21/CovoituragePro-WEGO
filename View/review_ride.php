<?php
include_once("../Connexion/connexion.php");
require_once("../Model/Review.php");

session_start();
// Vérification de la connexion et du rôle
if (!isset($_SESSION['email']) ) {
    header("Location: login.php");
    exit();
    
}
$trajet_id =($_GET['id_trajet']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Avis sur le trajet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star {
            color: gold;
            font-size: 1.2em;
        }
    </style>
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
    <h2 class="text-center mb-4"> Avis sur ce trajet</h2>


    <h4 class="mt-5">Laisser un avis</h4>
    <form method="post" action="../Controller/ControlReview.php" class="border p-4 rounded shadow-sm bg-light">
        <div class="mb-3">

        <input hidden type="" name="id_trajet" value="<?=$trajet_id?>">
            <label for="rating" class="form-label">Note (1 à 5)</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="">-- Choisir --</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> étoile<?= $i > 1 ? 's' : '' ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire</label>
            <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="home.php" class="btn btn-secondary ms-2">Retour</a>
    </form>
</div>
</body>
</html>
