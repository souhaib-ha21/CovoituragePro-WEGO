<?php
// Démarrer la session
session_start();

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou login après la déconnexion
header("Location: login.php");
exit();
?>

