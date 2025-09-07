<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("../Model/User.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $user = new User($email, null, null, $pass, null, null, null);

    if ($user->connect()) {
        $_SESSION['email'] = $email;
        $Usr=User::getUserByMail($email);

        $role = $Usr['role'];

        switch ($role) {
            case 0:
                header("Location: ../View/home.php");
                exit();
            case 1:
                header("Location: ../View/home_conducteur.php"); // à adapter selon ta page utilisateur
                exit();
            case 2:
                header("Location: ../View/menu_admin.php");
                exit();
            default:
                $_SESSION['error'] = "Rôle utilisateur inconnu.";
                header("Location: View/index.php");
                exit();
        }

    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect.";

        // ➤ Mode débogage :
        echo "<pre>";
        echo "DEBUG MODE - Connexion échouée\n";
        echo "Email : " . htmlspecialchars($email) . "\n";
        echo "Mot de passe : " . htmlspecialchars($pass) . "\n";
        var_dump($user);
        echo "</pre>";
        exit();
    }
}
?>
