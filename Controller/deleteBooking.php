<?php
include_once("../Connexion/connexion.php");
include_once("../Model/Booking.php");

if (isset($_GET['user_id'], $_GET['trajet_id'])) {
    $user_id = $_GET['user_id'];
    $trajet_id = $_GET['trajet_id'];
    Booking::deleteBooking($user_id, $trajet_id);
}

header("Location: my_bookings.php");
exit();
