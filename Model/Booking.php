<?php
include "../Connexion/connexion.php";
class Booking {
        public $email;
        public $trajet_id;
        public $status;
        public $created_at;
    
        public function __construct($email, $trajet_id, $status) {
            $this->email = $email;
            $this->trajet_id = $trajet_id;
            $this->status = $status;
            $this->created_at = date("Y-m-d H:i:s");
        }
    
    

    public function getUserId() { return $this->user_id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }

    public function getTrajetId() { return $this->trajet_id; }
    public function setTrajetId($trajet_id) { $this->trajet_id = $trajet_id; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }



public static function annulerbooking($id){
    global $pdo;
    $sql="UPDATE bookings set status=2 where trajet_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

public function ajoutBooking(){
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, trajet_id,status, created_at)
    VALUES (?, ?, ?, ?)");
$stmt->execute([$this->email,$this->trajet_id,$this->status,$this->created_at]);

}

public static function getBookingsByUser($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT b.user_id AS booking_id, t.depart, t.arrivee, t.date, t.heure, t.price, t.available_seats
                           FROM bookings b
                           JOIN trajets t ON b.trajet_id = t.id
                           WHERE b.user_id = ?");
    $stmt->execute([$email]); // Exécution avec le paramètre email
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats en tableau associatif
}


public static function deleteBooking($user_id, $trajet_id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE user_id = ? AND trajet_id = ?");
    return $stmt->execute([$user_id, $trajet_id]);
}


}


?>