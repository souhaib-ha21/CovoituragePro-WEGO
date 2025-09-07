<?php
session_start();
require_once 'connexion.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$message = '';
$ride_id = $_GET['ride_id'] ?? null;
$user_id = $_SESSION['user']['email']; // Email de l'utilisateur connecté

// Vérifier si un trajet a été sélectionné
if ($ride_id) {
    // Vérifier si l'utilisateur a déjà réservé ce trajet
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE user_id = ? AND ride_id = ?");
    $stmt->execute([$user_id, $ride_id]);
    $booking = $stmt->fetch();

    if (!$booking) {
        $message = "Vous devez d'abord réserver ce trajet avant de laisser un avis.";
    } else {
        // Si l'avis existe déjà
        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE user_id = ? AND ride_id = ?");
        $stmt->execute([$user_id, $ride_id]);
        $existing_review = $stmt->fetch();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            // Valider la note
            if ($rating < 1 || $rating > 5) {
                $message = "La note doit être entre 1 et 5.";
            } else {
                if ($existing_review) {
                    // Mise à jour de l'avis existant
                    $stmt = $pdo->prepare("UPDATE reviews SET rating = ?, comment = ?, created_at = NOW() WHERE user_id = ? AND ride_id = ?");
                    $stmt->execute([$rating, $comment, $user_id, $ride_id]);
                    $message = "Votre avis a été mis à jour avec succès.";
                } else {
                    // Ajouter un nouvel avis
                    $stmt = $pdo->prepare("INSERT INTO reviews (ride_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
                    $stmt->execute([$ride_id, $user_id, $rating, $comment]);
                    $message = "Merci pour votre avis !";
                }
            }
        }
    }
} else {
    $message = "Aucun trajet sélectionné.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un avis - Covoiturage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">Covoiturage</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <span class="nav-link text-white">Connecté en tant que <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="logout.php">Déconnexion</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="login.php">Connexion</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenu -->
<div class="container mt-5">
    <h2 class="mb-4">Laissez un avis sur votre trajet</h2>

    <?php if ($message): ?>
        <div class="alert <?= strpos($message, 'Erreur') !== false ? 'alert-danger' : 'alert-success' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <?php if ($booking): ?>
        <div class="card shadow p-4">
            <h5 class="card-title">Trajet réservé</h5>
            <p class="card-text">
                <strong>Trajet :</strong> <?= htmlspecialchars($booking['ride_id']) ?><br>
                <strong>Conducteur :</strong> <?= htmlspecialchars($booking['user_id']) ?>
            </p>

            <form method="POST">
                <div class="mb-3">
                    <label for="rating" class="form-label">Note (1 à 5)</label>
                    <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" value="<?= $existing_review ? $existing_review['rating'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Commentaire</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4"><?= $existing_review ? $existing_review['comment'] : '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre l'avis</button>
            </form>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
