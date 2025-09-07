<?php
include('../Connexion/Connexion.php'); // assure que $pdo est bien défini
include "../Model/Booking.php";

// Vérifie que la requête est bien en GET et que les paramètres nécessaires sont là
if ($_SERVER['REQUEST_METHOD'] === 'GET'&& isset($_GET['idtrj'])) {
    
    $idtrj= $_GET['idtrj'];

    // Appelle la méthode du modèle pour changer le statut
    $nouveau_status = Booking::annulerbooking($idtrj);

    if ($nouveau_status !== false) {
        // Tu peux éventuellement ajouter une notification ici en session
        // $_SESSION['message'] = "Statut mis à jour : $nouveau_status";
    } else {
        // $_SESSION['error'] = "Utilisateur non trouvé.";
    }

    // Redirection vers la liste
    header("Location: ../View/liste_trajets.php");
    exit();
}
?>
