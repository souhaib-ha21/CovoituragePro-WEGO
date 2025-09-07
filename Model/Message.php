<?php
class Message {
    private $id;
    private $sender;
    private $receiver;
    private $objet;
    private $message;

    public function __construct($sender, $receiver, $objet, $message) {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->objet = $objet;
        $this->message = $message;
    }

    public  function sendMessage() {
        global $pdo;
    
        $sql = "INSERT INTO message (sender, receiver, objet, message) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->sender, $this->receiver, $this->objet, $this->message]);
    }
    

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getSender() { return $this->sender; }
    public function setSender($sender) { $this->sender = $sender; }

    public function getReceiver() { return $this->receiver; }
    public function setReceiver($receiver) { $this->receiver = $receiver; }

    public function getObjet() { return $this->objet; }
    public function setObjet($objet) { $this->objet = $objet; }

    public function getMessage() { return $this->message; }
    public function setMessage($message) { $this->message = $message; }

    public function getDateEnvoi() { return $this->date_envoi; }
    public function setDateEnvoi($date_envoi) { $this->date_envoi = $date_envoi; }

    public static function getReceivedMessages($email) {
        global $pdo;
        
        $sql = "
            SELECT message.*, users.nom, users.prenom 
            FROM message  
            JOIN users ON message.sender = users.email  
            WHERE receiver = ?
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function getSentMessages($email) {
        global $pdo;
        
        $sql = "
            SELECT message.*, users.nom, users.prenom 
            FROM message  
            JOIN users ON message.sender = users.email  
            WHERE sender= ?
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>