<?php


class Recurrent {
    private $trajet_id;
    private $lun;
    private $mardi;
    private $merc;
    private $jeudi;
    private $vend;
    private $sam;
    private $dim;
    
        public function __construct($trajet_id,$lun,$mardi,$merc,$jeudi,$vend,$sam,$dim) {
            $this->trajet_id = $trajet_id;
            $this->lun   = $lun ;
            $this->mardi = $mardi;
            $this->merc  = $merc ; 
            $this->jeudi = $jeudi;
            $this->vend  = $vend;
            $this->sam   = $sam;
            $this->dim   = $dim;
        }
        public function add() {
            global $pdo;
            $stmt = $pdo->prepare("INSERT INTO recurrent (trajet_id,lun, mardi, merc, jeudi, vend, sam, dim) VALUES (?,?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $this->trajet_id,
                $this->lun,
                $this->mardi,
                $this->merc,
                $this->jeudi,
                $this->vend,
                $this->sam,
                $this->dim
            ]);
    
            if ($stmt->execute()) {
                echo "✔️ Insertion réussie dans la base de données.";
            } else {
                echo "❌ Erreur d'insertion : " . $stmt->error;
            }
    
            $stmt->close();
            $this->conn->close();
        }


    public function getTrajetId() { return $this->trajet_id; }
    public function setTrajetId($trajet_id) { $this->trajet_id = $trajet_id; }

    public function getLun() { return $this->lun; }
    public function setLun($lun) { $this->lun = $lun; }

    public function getMardi() { return $this->mardi; }
    public function setMardi($mardi) { $this->mardi = $mardi; }

    public function getMerc() { return $this->merc; }
    public function setMerc($merc) { $this->merc = $merc; }

    public function getJeudi() { return $this->jeudi; }
    public function setJeudi($jeudi) { $this->jeudi = $jeudi; }

    public function getVend() { return $this->vend; }
    public function setVend($vend) { $this->vend = $vend; }

    public function getSam() { return $this->sam; }
    public function setSam($sam) { $this->sam = $sam; }

    public function getDim() { return $this->dim; }
    public function setDim($dim) { $this->dim = $dim; }
}


?>