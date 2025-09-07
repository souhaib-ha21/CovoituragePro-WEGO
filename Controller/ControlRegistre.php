<?php
include "../Connexion/connexion.php";
include "../Model/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Sans hachage
    $confirm_password = $_POST['confirm_password'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $role = $_POST['role'];
    $cin = $_POST['cin'];
$usr=new User($email, $nom, $prenom, $password, $telephone, $role, $cin);
    // Vérification de la correspondance des mots de passe
    if ($password != $confirm_password) {
        $error_message = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'email existe déjà dans la base de données
        // $sql = "SELECT * FROM users WHERE email = '$email'";
        // $result = $conn->query($sql);

        if (User::verifExistMail($email)>0) {
            $error_message = "Cet email est déjà utilisé.";
        } else {
            // Insérer les données dans la base de données
            // $sql = "INSERT INTO users (nom, prenom, email, password, telephone, role, cin,status)
            //         VALUES ('$nom', '$prenom', '$email', '$password', '$telephone', '$role', '$cin','Actif')";

            if (!$usr->ajoutUser()) {
                // Ajouter une alerte JavaScript avant de rediriger
                echo "<script type='text/javascript'>
                        alert('Bienvenue dans la communauté et ajout avec succès');
                        window.location.href = '../View/login.php';
                      </script>";
                exit();
            } else {
echo"error";            }
        }
    }
}
?>