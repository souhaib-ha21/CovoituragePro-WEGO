<?php
include "../Connexion/Connexion.php";


class User {
    private $email;
    private $nom;
    private $prenom;
    private $password;
    private $telephone;
    private $adresse;
    private $role;
    private $cin;

    // public function __construct($email, $password,) {
    //     $this->email = $email;
    //     $this->password = $password;
    // }
    public function __construct($email, $nom, $prenom, $password, $telephone, $role, $cin) {
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->role = $role;
        $this->cin = $cin;
    }

    public function getEmail() { return $this->email; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getPassword() { return $this->password; }
    public function getTelephone() { return $this->telephone; }
    public function getAdresse() { return $this->adresse; }
    public function getRole() { return $this->role; }
    public function getCin() { return $this->cin; }

    function getRoleName($role) {
        $roles = [
            0 => 'passager',
            1 => 'conducteur',
            2 => 'admin'
        ];
        return $roles[$role] ?? 'inconnu';
    }

    public function connect() {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? and password=?");
        $stmt->execute([$this->email,$this->password]);
        $nombre_lignes = $stmt->rowCount();
        if ($nombre_lignes>0){
            return true;
        }
        else return false;
    }

    public function register() {
        include("connexion.php");

        // PAS de hash ici (mot de passe stocké en clair)
        $stmt = $pdo->prepare("INSERT INTO users (email, nom, prenom, password, telephone, adresse, role, cin) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $this->email, $this->nom, $this->prenom, $this->password,
            $this->telephone, $this->adresse, $this->role, $this->cin
        ]);
    }

    public static function CountNbUser(){
        global $pdo;
        return $nb_clients = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 0 ;")->fetchColumn();

    }
Public static function CountNbCond(){
    global $pdo;
    $sql = "SELECT COUNT(*) AS total_conducteurs FROM users WHERE role = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchColumn();

return $result;
}
public Static function GetAllClt(){
    global $pdo;
$sql = "SELECT email, nom, status FROM users WHERE role = 0";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $clients;
}

public static function toggleUserStatus($email) {
    global $pdo;

    // Vérifier le statut actuel
    $stmt = $pdo->prepare("SELECT status FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $nouveau_status = ($user['status'] === 'Actif') ? 'bloqué' : 'Actif';

        // Mettre à jour le statut
        $update = $pdo->prepare("UPDATE users SET status = ? WHERE email = ?");
        $update->execute([$nouveau_status, $email]);

        return $nouveau_status; // Utile pour afficher une confirmation
    } else {
        return false; // Email introuvable
    }
}

public static function verifExistMail($email){
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = ?";
    $result = $pdo->prepare($sql);
    $result->execute([$email]);
    
    $nombre_lignes = $result->rowCount();
    return $nombre_lignes;
    

}

public function ajoutUser(){
    global $pdo;
    $sql = "INSERT INTO users (nom, prenom, email, password, telephone, role, cin, status)
    VALUES (:nom, :prenom, :email, :password, :telephone, :role, :cin, 'Actif')";

$stmt = $pdo->prepare($sql);
$stmt->execute([
':nom' => $this->nom,
':prenom' => $this->prenom,
':email' => $this->email,
':password' => $this->password, 
':telephone' => $this->telephone,
':role' =>$this->role,
':cin' => $this->cin
]);

}
public static function getUserByMail($email) {
    global $pdo;

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    // Si trouvé, retourne l'utilisateur (tableau associatif), sinon false
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public static function getTrajetByCond($trajet_id,$email){
    $check_sql = "SELECT * FROM trajets WHERE id = :id AND driver_email = :email";
    $stmt = $pdo->prepare($check_sql);
    $stmt->bindParam(':id', $trajet_id, PDO::PARAM_INT);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}



// liste des conduteurs lkol li aandhom trajets 
public static function getAllCond (){
    global $pdo;

     $sql="SELECT DISTINCT u.email, u.nom, u.prenom FROM users u  JOIN trajets t ON u.email = t.driver_email";
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
    $conducteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $conducteurs;

}

public static function getAllClients () {
    global $pdo; 
    $sql = "SELECT DISTINCT u.*
            FROM users u
            JOIN bookings b ON u.email = b.user_id";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
?>
