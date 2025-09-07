<?php
include '../Model/Recurrent.php';
include '../Model/Trajet.php';

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

    $idtrj=isset($_GET['idtrj']) ;
    $lun   = isset($_POST['lun'])   ? 1 : 0;
$mardi = isset($_POST['mardi']) ? 1 : 0;
$merc  = isset($_POST['merc'])  ? 1 : 0;
$jeudi = isset($_POST['jeudi']) ? 1 : 0;
$vend  = isset($_POST['vend'])  ? 1 : 0;
$sam   = isset($_POST['sam'])   ? 1 : 0;
$dim   = isset($_POST['dim'])   ? 1 : 0;
$rec=new Recurrent($idtrj,$lun,$mardi,$merc,$jeudi,$vend,$sam,$dim);


    // Validation simple
        if($rec->add()) {
            $rec=new Recurrent($idtrj,$lun,$mardi,$merc,$jeudi,$vend,$sam,$dim);
            echo "Trajet ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du trajet.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";

    }


?>
