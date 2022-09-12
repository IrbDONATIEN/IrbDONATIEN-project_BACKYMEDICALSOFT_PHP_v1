<?php
    require_once 'config.php';
    class Fichemedicale extends Database{

        //Enregistrer fiche médicale patient 
        public function add_fichemedicale($date_creation,$description,$patient_id){
            $sql="INSERT INTO fiche_medicale(date_creation,description,patient_id) VALUES (:date_creation,:description,:patient_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['date_creation'=>$date_creation,'description'=>$description,'patient_id'=>$patient_id]);
            return true;
        }

        //Affichage avant l'édition de la fiche médicale de patient existante dans la base de données
        public function editerFicheMedicale($id){
            $sql="SELECT * FROM fiche_medicale WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de la fiche médicale de patient
        public function update_fichemedicale($id,$date_creation,$description,$patient_id){
            $sql="UPDATE fiche_medicale SET date_creation=:date_creation,description=:description,patient_id=:patient_id WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['date_creation'=>$date_creation,'description'=>$description,'patient_id'=>$patient_id,'id'=>$id]);
            return true;
        }

        //Delete fiche médicale patient
        public function deleteFichemedicale($id){
            $sql="DELETE FROM fiche_medicale WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les fiches médicales patients
        public function afficherFichesmedicales(){
            $sql="SELECT id,date_creation,description,patient_id,patient.nom,patient.postnom,patient.prenom,patient.sexe,patient.lieu_naissance,patient.date_naissance,patient.age,patient.telephone,patient.profession,patient.etat_civil,patient.adresse_domicile FROM fiche_medicale INNER JOIN patient ON fiche_medicale.patient_id=patient.id_patient";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>