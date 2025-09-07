<?php
include_once("../Connexion/connexion.php");

session_start();
// Vérification de la connexion et du rôle
if (!isset($_SESSION['email']) ) {
    header("Location: login.php");
    exit();
}
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
          <a class="nav-link" href="menu_admin.php">Acceuil </a>
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



      </ul>
      <div class="d-flex">
      <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
      </div>
    </div>
  </div>
</nav>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Liste des Clients</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include "../Model/User.php";
        $clients=User::GetAllClt();
        foreach ($clients as $client): ?>
            <tr>
                <td><?= htmlspecialchars($client['nom']) ?></td>
                <td><?= htmlspecialchars($client['email']) ?></td>
                <td>
                    <?= $client['status'] === 'Actif' ? ' Actif' : ' Bloqué' ?>
                </td>
                <td>
                <form method="GET" action="../Controller/ControlLstClt.php" style="display:inline;">
    <input type="hidden" name="toggle_status" value="1">
    <input type="hidden" name="email" value="<?= $client['email'] ?>">
    <button type="submit" class="btn btn-sm <?= $client['status'] === 'Actif' ? 'btn-danger' : 'btn-success' ?>">
        <?= $client['status'] === 'Actif' ? 'Bloquer' : 'Débloquer' ?>
    </button>
</form>

                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
