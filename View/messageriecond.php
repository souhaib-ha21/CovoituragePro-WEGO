<?php
include_once "../Controller/ControlMsgCond.php";
include_once "../Connexion/connexion.php";
include_once "../Model/User.php";


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email=$_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - WeGo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css" rel="stylesheet">
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
    <h3 class="text-center text-light mb-4">Messagerie interne</h3>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <!-- Formulaire d'envoi de message -->
    <div class="card mb-4">
        <div class="card-header">Envoyer un message</div>
        <div class="card-body">
            <form method="POST" action="../Controller/ControlMsgClt.php">
                <div class="mb-3">
                    <label class="form-label">Destinataire</label>
                    <select name="receiver" class="form-select" required>
                        <option value="">-- Choisir un passager  --</option>
                        <?php 
                        $users=User::getAllClients();
                        foreach ($users as $user): ?>
                            <option value="<?= $user['email'] ?>"><?= $user['nom'] . ' ' . $user['prenom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Objet</label>
                    <input type="text" name="objet" class="form-control" placeholder="Objet du message" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Votre message..." required></textarea>
                </div>
                <button type="submit" nom="envoi" class="btn btn-primary w-100">Envoyer</button>
            </form>
        </div>
    </div>

    <!-- Boîte de réception -->
    <div class="card mb-4">
        <div class="card-header">Boîte de réception</div>
        <div class="card-body">
            <?php 
            $receivedMessages= Message::getReceivedMessages($email);

            if (count($receivedMessages) > 0): ?>
                <?php foreach ($receivedMessages as $msg): ?>
                    <div class="border-bottom mb-2 pb-2">
                        <strong>De :</strong> <?= $msg['nom'] . ' ' . $msg['prenom'] ?><br>
                        <strong>Objet :</strong> <?= htmlspecialchars($msg['objet']) ?><br>
                        <strong>Message :</strong> <?= htmlspecialchars($msg['message']) ?><br>
                
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun message reçu.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Messages envoyés -->
    <div class="card mb-5">
        <div class="card-header">Messages envoyés</div>
        <div class="card-body">
            <?php 
            $sentMessages= Message::getSentMessages($email);
            if (count($sentMessages) > 0): ?>
                <?php foreach ($sentMessages as $msg): ?>
                    <div class="border-bottom mb-2 pb-2">
                        <strong>À :</strong> <?= $msg['nom'] . ' ' . $msg['prenom'] ?><br>
                        <strong>Objet :</strong> <?= htmlspecialchars($msg['objet']) ?><br>
                        <strong>Message :</strong> <?= htmlspecialchars($msg['message']) ?><br>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun message envoyé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>



