<?php
// -------------------------
// Informations de connexion
// -------------------------
$host = 'localhost';          // Adresse du serveur MySQL (localhost si en local)
$dbname = 'covoituragebd';   // Nom de ta base de données
$username = 'root';          // Nom d'utilisateur (par défaut 'root' sur XAMPP/WAMP)
$password = '';              // Mot de passe (par défaut vide sur XAMPP)

// ----------------------------
// Connexion à la base de données
// ----------------------------
try {
    // Création de l'objet PDO pour établir la connexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // -------------------------------
    // Configuration des options PDO
    // -------------------------------

    // Active les erreurs (très utile pour le debug)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Facultatif : mode FETCH_ASSOC par défaut
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Connexion réussie (tu peux l'afficher pour tester)
    // echo "Connexion réussie à la base de données !";

} catch (PDOException $e) {
    // En cas d'erreur de connexion, on arrête le script et on affiche un message
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!-- 
 // function verif($file_name,$folder){
//     $photo_name=time().$file_name;
// if(file_exists($folder."/".$photo_name)){
//     verif($file_name,$folder);
// }else{
//     return $photo_name;
// }
// }

// function upload($file,$folders,$max_size,$accept_type){
//     //recupérer le nom du fichier
//     $photo_name=$file['name'];
//     //renomer le nom du fichier
//     $photo_name=verif($photo_name,$folders);
//     $error="";
//     //verifier le type du fichier (accepter que des images de type png, gif, jpeg, jpg)
//     if (!in_array($file["type"],$accept_type))
//     {
//         $error.="vérifier le type de votre fichier!<br>";
//     }
    
//     //vérifier la taille du fichier ne doit pas dépasser 2Mo
//     if($file['size']/1024>$max_size){
//         $error.="vérifier la taille de votre fichier!<br>";
//     }
    
//     //copier la copie temporaire dans le dossier /uploads/
//     //jusqu'a php 7.x (deprecated)
//     //move_uploaded_file($_FILES['photo']['name'],"uploads/$photo_name");
//     //à partir de php8.x
//     if(empty($error)){
//     copy($file['tmp_name'],"$folders/$photo_name");
//     echo "success d'upload!";
//     }
//     else
//     echo $error."<a href='upload.html'><button>Réessayer</button></a>";
    
//     return $photo_name;
//     }
//  -->