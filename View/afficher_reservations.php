<?php
    include_once "../Connexion/connexion.php";
    include_once "../Model/Trajet.php";



// Vérifie que l’ID est bien présent dans l’URL
if (!isset($_GET['id'])) {
    die("ID de trajet non fourni.");
}

$trajet_id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réservations du Trajet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2 class="mb-4">Réservations pour le trajet #<?= htmlspecialchars($trajet_id) ?></h2>

<?php //if (count($reservations) > 0): ?>
  <?php if($reservations=Trajet::getAllTrajetsbyId($trajet_id)): ?>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Actions </th> 
      </tr>
    </thead>
    <tbody>
    <tbody>
  <?php 
  //$reservations=Trajet::getAllTrajetsbyId($trajet_id);
  foreach ($reservations as $res): ?>
    <tr>
      <td><?= htmlspecialchars($res['nom']) ?></td>
      <td><?= htmlspecialchars($res['prenom']) ?></td>
      <td><?= htmlspecialchars($res['email']) ?></td>
      <td>
    
  <form action="Controller/traiter_reservation.php" method="post" class="d-inline">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($res['user_id']) ?>">
    <input type="hidden" name="trajet_id" value="<?= htmlspecialchars($res['trajet_id']) ?>">
    <input type="hidden" name="action" value="confirmer">
    <button type="submit" class="btn btn-success btn-sm">Confirmer</button>
  </form>
  <form action="Controller/traiter_reservation.php" method="post" class="d-inline">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($res['user_id']) ?>">
    <input type="hidden" name="trajet_id" value="<?= htmlspecialchars($res['trajet_id']) ?>">
    <input type="hidden" name="action" value="refuser">
    <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
  </form>
</td>

    </tr>
  <?php endforeach; ?>
</tbody>

  </table>
<?php else: ?>
  <div class="alert alert-info">Aucune réservation trouvée pour ce trajet.</div>
<?php endif; ?>

<a href="home_conducteur.php" class="btn btn-secondary mt-3">Retour</a>

</body>
</html>
