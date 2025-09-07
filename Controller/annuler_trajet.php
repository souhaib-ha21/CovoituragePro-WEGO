<?php
include "../Model/Booking.php";
include "../Model/Trajet.php";

session_start();


if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include_once "../Connexion/connexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // $email = $_SESSION['email'];

    // Vérifier que le trajet appartient bien à ce conducteur
  

        // Trajet trouvé et appartient au conducteur -> mise à jour du statut
        Booking::annulerbooking($id);
        Trajet::supprimerTrajet($id) ;
        header("Location: ../View/home_conducteur.php?msg=trajet_annulé");
        exit();
    } else {
        // Tentative non autorisée
        echo "<p style='color: red; text-align:center;'>Erreur : Ce trajet ne vous appartient pas ou n'existe pas.</p>";
        echo "<p style='text-align:center;'><a href='home_conducteur.php'>Retour</a></p>";
        exit();
    }

?>
