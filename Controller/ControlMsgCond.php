<?php
session_start();
include('../Connexion/connexion.php');
include_once "../Model/User.php";
include_once '../Model/Message.php';

// Vérification de la connexion et du rôle
if (!isset($_SESSION['email']) ) {
    header("Location: ../View/Login.php");
    exit();
}

$email = $_SESSION['email']; // Récupère l'email de l'utilisateur connecté

// Envoi de message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['receiver'], $_POST['objet'], $_POST['message'])) {
    $sender=$_SESSION['email'];
    $receiver = $_POST['receiver'];
    $objet = $_POST['objet'];
    $message = $_POST['message'];

    $msg=new Message($sender, $receiver, $objet, $message);
    if($msg->sendMessage()){

    // Message de succès
    echo "<script type='text/javascript'>
    alert('Message envoyé');
    window.location.href = '../View/messageriecond.php';
    </script>";fetchAll(PDO::FETCH_ASSOC);
    
    exit(); // Stop further execution after redirect
}



}

?>
