<?php
require_once("../Connexion/connexion.php");
require_once("../Model/Review.php");

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../View/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!empty($_POST['rating']) && !empty($_POST['comment']) && !empty($_POST['id_trajet'])) {
        $user_id = $_SESSION['email'];
        $id_trajet = $_POST['id_trajet'];
        $rating = intval($_POST['rating']);
        $comment = htmlspecialchars($_POST['comment']);
        $created_at = date('Y-m-d H:i:s');
        $rvw=new Review($id_trajet, $user_id, $rating, $comment ,$created_at);
        
        

        if (!$rvw->addReview()) {
            header("Location: ../View/review_ride.php?id_trajet=$id_trajet&success=1");
            exit();
        } else {
            header("Location: ../View/review_ride.php?id_trajet=$id_trajet&error=1");
            exit();
            
        }
    } else {
        header("Location: ../View/review_ride.php?id_trajet=$id_trajet&error=missing");
        exit();
    }
}
?>





























