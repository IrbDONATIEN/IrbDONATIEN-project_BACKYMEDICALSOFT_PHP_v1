<?php
    require_once 'config.php';
    class Patient extends Database{

        //Enregistrer patient 
        public function add_patient($nom,$postnom,$prenom,$sexe,$lieu_naissance,$date_naissance,$age,$telephone,$profession,$etat_civil,$adresse_domicile){
            $sql="INSERT INTO patient(nom,postnom,prenom,sexe,lieu_naissance,date_naissance,age,telephone,profession,etat_civil, adresse_domicile) VALUES (:nom,:postnom,:prenom,:sexe,:lieu_naissance,:date_naissance,:age,:telephone,:profession,:etat_civil,:adresse_domicile)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom'=>$nom,'postnom'=>$postnom,'prenom'=>$prenom,'sexe'=>$sexe,'lieu_naissance'=>$lieu_naissance,'date_naissance'=>$date_naissance,'age'=>$age,'telephone'=>$telephone,'profession'=>$profession,'etat_civil'=>$etat_civil,'adresse_domicile'=>$adresse_domicile]);
            return true;
        }

        //Affichage avant l'édition de patient existant dans la base de données
        public function editerPatient($id){
            $sql="SELECT * FROM patient WHERE id_patient=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de patient
        public function update_facture($id,$nom,$postnom,$prenom,$sexe,$lieu_naissance,$date_naissance,$age,$telephone,$profession,$etat_civil,$adresse_domicile){
            $sql="UPDATE patient SET nom=:nom,postnom=:postnom,prenom=:prenom,sexe=:sexe,lieu_naissance=:lieu_naissance,date_naissance=:date_naissance,age=:age,telephone=:telephone,profession=:profession,etat_civil=:etat_civil,adresse_domicile=:adresse_domicile WHERE id_patient=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom'=>$nom,'postnom'=>$postnom,'prenom'=>$prenom,'sexe'=>$sexe,'lieu_naissance'=>$lieu_naissance,'date_naissance'=>$date_naissance,'age'=>$age,'telephone'=>$telephone,'profession'=>$profession,'etat_civil'=>$etat_civil,'adresse_domicile'=>$adresse_domicile,'id'=>$id]);
            return true;
        }

        //Delete patient
        public function deletePatient($id){
            $sql="DELETE FROM patient WHERE id_patient=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les patients
        public function afficherPatients(){
            $sql="SELECT id_patient,nom,postnom,prenom,sexe,lieu_naissance,date_naissance,age,telephone,profession,etat_civil, adresse_domicile,create_date FROM patient";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>