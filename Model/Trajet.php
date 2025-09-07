<?php
    include_once "../Connexion/connexion.php";


class Trajet {
    private $id;
    private $depart;
    private $arrivee;
    private $date;
    private $availables_seats;
    private $price;

    // Connexion à la BDD

    public function __construct($id, $depart, $arrivee, $date, $driver_email, $available_seats, $price, $heure, $status) {
        $this->id = $id;
        $this->depart = $depart;
        $this->arrivee = $arrivee;
        $this->date = $date;
        $this->driver_email = $driver_email;
        $this->available_seats = $available_seats;
        $this->price = $price;
        $this->heure = $heure;
        $this->status = $status;
    }
    


public function ajouterTrajet(){
global $pdo;
    $sql = "INSERT INTO trajets (date, heure, depart, arrivee, available_seats, price, driver_email) 
    VALUES (:date, :heure, :lieu_depart, :lieu_arrivee, :available_seats, :price, :driver_email)";
    
    // Préparer la requête
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':date', $this->date);
    $stmt->bindParam(':heure', $this->heure);
    $stmt->bindParam(':lieu_depart', $this->depart);
    $stmt->bindParam(':lieu_arrivee', $this->arrivee);
    $stmt->bindParam(':available_seats', $this->available_seats, PDO::PARAM_INT); // Utiliser PDO::PARAM_INT pour les entiers
    $stmt->bindParam(':price', $this->price, PDO::PARAM_INT); // Utiliser PDO::PARAM_INT pour les entiers
    $stmt->bindParam(':driver_email', $this->driver_email);

    // Exécuter la requête
    return $stmt->execute();
}

public static function getAllTrajetsById($trajet_id){
    global $pdo;

    $sql = "SELECT bookings.user_id, bookings.trajet_id, users.nom, users.prenom, users.email, bookings.status
FROM bookings 
JOIN users ON bookings.user_id = users.email
WHERE bookings.trajet_id = :id";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $trajet_id, PDO::PARAM_INT);
$stmt->execute();

$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $reservations;
}

public static function getAllTrajets(){
    global $pdo;

    $sql = "SELECT * FROM trajets WHERE available_seats > 0 AND status = 0 ORDER BY date ASC";
    $stmt = $pdo->query($sql);
    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $trajets;
}

public static function getTrajetByCondMail($email){
    global $pdo;
    $sql_trajets = "SELECT * FROM trajets WHERE driver_email = :email ORDER BY date ASC";
$stmt_trajets = $pdo->prepare($sql_trajets);
$stmt_trajets->bindParam(':email', $email, PDO::PARAM_STR);
$stmt_trajets->execute();
$result_trajets = $stmt_trajets->fetchAll(PDO::FETCH_ASSOC);
return $result_trajets;
}


public static function CountNbTrajet(){
    global $pdo;
   return $pdo->query("SELECT COUNT(*) FROM trajets ")->fetchColumn();
}


public static function supprimerTrajet($id) {
    global $pdo;

    $sql = "DELETE FROM trajets WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]); // retourne true si succès
}


//////////////////////////////////////////////////
public static function isRecurrent($trajet_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT * FROM recurrent WHERE trajet_id = ?");
    $stmt->execute([$trajet_id]);
    return $stmt->fetchColumn() > 0;
    
}


public static function getTrajetById($id){
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM trajets WHERE id = ?");
    $stmt->execute([$id]);
    $trajet = $stmt->fetch(PDO::FETCH_ASSOC);
    return $trajet;

}

}
?>
