<?php
require_once '../Connexion/connexion.php';

class Review
{
    public $id_trajet;
    public $user_id;
    public $rating;
    public $comment;
    public $created_at;

    // Constructeur (optionnel)
    public function __construct($id_trajet, $user_id, $rating, $comment, $created_at)
    {
        $this->id_trajet = $id_trajet;
        $this->user_id = $user_id;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->created_at = $created_at;
    }





    // ✅ Méthode statique pour récupérer les avis d’un trajet
    public static function getReviewsByTrajet($trajet_id)
    {
        global $pdo;

        $sql = "SELECT r.rating, r.comment, r.created_at, u.nom, u.prenom
                FROM reviews r
                JOIN users u ON r.user_id = u.email
                WHERE r.id_trajet = ?
                ORDER BY r.created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$trajet_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // ✅ Méthode pour insérer un nouvel avis
    public function addReview()
    {
        global $pdo;

        $sql = "INSERT INTO reviews (id_trajet, user_id, rating, comment, created_at) 
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$this->id_trajet, $this->user_id, $this->rating, $this->comment]);
    }


    // traje3 les noms mtaa laabed li 3taw rayhom 
    public static function getAllReviewsWithUsers()
{
    global $pdo;

    $sql = "SELECT r.*, u.nom 
            FROM reviews r 
            JOIN users u ON r.user_id = u.email";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>
