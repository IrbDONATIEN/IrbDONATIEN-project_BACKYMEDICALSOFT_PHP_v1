<?php
    require_once 'config.php';
    class Signesvitaux extends Database{

        //Enregistrer signes vitaux patient 
        public function add_signes_vitaux($taille,$poids,$frequence,$temperature,$tension,$patient_signe_id){
            $sql="INSERT INTO signes_vitaux(taille,poids,frequence,temperature,tension,patient_signe_id) VALUES (:taille,:poids,:frequence,:temperature,:tension,:patient_signe_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['taille'=>$taille,'poids'=>$poids,'frequence'=>$frequence,'temperature'=>$temperature,'tension'=>$tension,'patient_signe_id'=>$patient_signe_id]);
            return true;
        }

        //Affichage avant l'édition des signes vitaux de patient existant dans la base de données
        public function editerSignes_vitaux($id){
            $sql="SELECT * FROM signes_vitaux WHERE id_signe=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite des signes vitaux patient
        public function update_signes_vitaux($id,$taille,$poids,$frequence,$temperature,$tension,$patient_signe_id){
            $sql="UPDATE signes_vitaux SET taille=:taille,poids=:poids,frequence=:frequence,temperature=:temperature,tension=:tension,patient_signe_id=:patient_signe_id WHERE signes_vitaux.id_signe=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['taille'=>$taille,'poids'=>$poids,'frequence'=>$frequence,'temperature'=>$temperature,'tension'=>$tension,'patient_signe_id'=>$patient_signe_id,'id'=>$id]);
            return true;
        }

        //Delete signes vitaux patient
        public function deleteSigneVitaux($id){
            $sql="DELETE FROM signes_vitaux WHERE id_signe=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les signes vitaux patients
        public function afficherSignesVitauxPatients(){
            $sql="SELECT id_signe,taille,poids,frequence,temperature,tension,patient_signe_id,patient.nom,patient.postnom,patient.prenom,patient.sexe,patient.lieu_naissance,patient.date_naissance,patient.age,patient.telephone,patient.profession,patient.etat_civil,patient.adresse_domicile,dateCreation FROM signes_vitaux INNER JOIN patient ON signes_vitaux.patient_signe_id=patient.id_patient";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>