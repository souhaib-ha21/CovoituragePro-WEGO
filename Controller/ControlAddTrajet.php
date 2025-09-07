<?php

session_start();

if (isset($_SESSION['email'])) {
    $driver_email = $_SESSION['email'];
} else {
    die("Erreur : utilisateur non connecté !");
}


// Connexion à la base de données
include_once "../Connexion/connexion.php";
include_once "../Model/Trajet.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $available_seats = $_POST['available_seats'];
    $price = $_POST['price'];
    $driver_email = $_SESSION['email'];

$tr=new Trajet(null, $depart, $arrivee, $date, $driver_email, $available_seats, $price, $heure, 0);

    // Validation simple
    if (!empty($date) && !empty($heure) && !empty($depart) && !empty($arrivee) && !empty($available_seats) && !empty($price)) {
        if($tr->ajouterTrajet()) {
            echo "Trajet ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du trajet.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";

    }

}
?>