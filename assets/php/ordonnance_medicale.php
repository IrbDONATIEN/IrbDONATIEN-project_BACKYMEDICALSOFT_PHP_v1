<?php
    require_once 'config.php';
    class Ordonnancemedicale extends Database{

        //Enregistrer ordonnance médicale patient 
        public function add_ordonnance_medicale($description_medicament,$examen_id,$patient_ordo_id){
            $sql="INSERT INTO ordonnance_medicale(description_medicament,examen_id,patient_ordo_id) VALUES (:description_medicament,:examen_id,:patient_ordo_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['description_medicament'=>$description_medicament,'patient_ordo_id'=>$patient_ordo_id,'examen_id'=>$examen_id]);
            return true;
        }

        //Affichage avant l'édition d'ordonnance médicale de patient existant dans la base de données
        public function editerOrdonnance_medicale($id){
            $sql="SELECT * FROM ordonnance_medicale WHERE id_ordonnance=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite d'ordonnance médicale patient
        public function update_ordonnance_medicale($id,$description_medicament,$examen_id,$patient_ordo_id){
            $sql="UPDATE ordonnance_medicale SET description_medicament=:description_medicament,examen_id=:examen_id,patient_ordo_id=:patient_ordo_id WHERE id_ordonnance=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['description_medicament'=>$description_medicament,'examen_id'=>$examen_id,'patient_ordo_id'=>$patient_ordo_id,'id'=>$id]);
            return true;
        }

        //Delete ordonnance médicale patient
        public function deleteOrdonnancemedicale($id){
            $sql="DELETE FROM ordonnance_medicale WHERE id_ordonnance=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les ordonnances médicales des patients
        public function afficherOrdonnancesmedicales(){
            $sql="SELECT id_ordonnance,description_medicament,examen_id,examen_labo.glycemie,examen_labo.selles,examen_labo.sang,examen_labo.urines,examen_labo.crachat,examen_labo.date_examen,examen_labo.publier,examen_labo.signes_vitaux_id, date_prescription,patient_ordo_id, patient.nom, patient.postnom,patient.prenom,patient.sexe,patient.etat_civil,patient.lieu_naissance,patient.date_naissance,patient.profession FROM ordonnance_medicale INNER JOIN patient ON ordonnance_medicale.patient_ordo_id=patient.id_patient INNER JOIN examen_labo ON ordonnance_medicale.examen_id=examen_labo.id_examen";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>