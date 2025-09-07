
<?php
session_start();
include('../Connexion/connexion.php');
include_once "../Model/Booking.php";

// Vérification de la connexion et du rôle
if (!isset($_SESSION['email'])) {
    header("Location: ../!view/Login.php");
    exit();
}

$email = $_SESSION['email']; // Récupère l'email de l'utilisateur connecté

// Instantiate the Booking class

// Variables for success and error messages
$success = '';
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the hidden inputs
    $trajet_id = $_POST['id'];
    $depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $driver_name = $_POST['driver_name'];
    $price = $_POST['price']; 
    $available_seats = $_POST['available_seats'];
    $booking = new Booking($email,$trajet_id,0);
    $booking->ajoutBooking();

    // Now you can process these values as needed, e.g., store the booking in the database
    // Example of inserting into a booking table

    // Optionally, redirect the user or show a success message
    echo "<script type='text/javascript'>
    alert('ajout avec succès');
    window.location.href = '../View/my_bookings.php';
  </script>"; // Example redirection
    exit();
}
?>


