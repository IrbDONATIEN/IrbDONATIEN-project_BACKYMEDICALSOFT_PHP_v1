<?php
    require_once 'config.php';
    class Examenlabo extends Database{

        //Enregistrer Examen labo patient 
        public function add_examen_labo($glycemie,$selles,$sang,$urines,$crachat,$signes_vitaux_id){
            $sql="INSERT INTO examen_labo (glycemie,selles,sang,urines,crachat,signes_vitaux_id) VALUES (:glycemie,:selles,:sang,:urines,:crachat,:signes_vitaux_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['glycemie'=>$glycemie,'selles'=>$selles,'sang'=>$sang,'urines'=>$urines,'crachat'=>$crachat,'signes_vitaux_id'=>$signes_vitaux_id]);
            return true;
        }

        //Affichage avant l'édition d'examen labo de patient existant dans la base de données
        public function editerExamen_labo($id){
            $sql="SELECT * FROM examen_labo WHERE id_examen=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite d'examen labo patient
        public function update_examen_labo($id,$glycemie,$selles,$sang,$urines,$crachat,$signes_vitaux_id){
            $sql="UPDATE examen_labo SET glycemie=:glycemie,selles=:selles,sang=:sang,urines=:urines,crachat=:crachat,signes_vitaux_id=:signes_vitaux_id WHERE id_examen=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['glycemie'=>$glycemie,'selles'=>$selles,'sang'=>$sang,'urines'=>$urines,'crachat'=>$crachat,'signes_vitaux_id'=>$signes_vitaux_id,'id'=>$id]);
            return true;
        }

        //Delete examen labo patient
        public function deleteExamenLabo($id){
            $sql="DELETE FROM examen_labo WHERE id_examen=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Valider examen labo patient
        public function publierExamenLabo($id){
            $sql="UPDATE examen_labo SET publier=1 WHERE id_examen=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les examens laboratoires des patients
        public function afficherExamensLaboPatients(){
            $sql="SELECT id_signe,taille,poids,frequence,temperature,tension,patient_signe_id,patient.nom,patient.postnom,patient.prenom,patient.sexe,patient.lieu_naissance,patient.date_naissance,patient.age,patient.telephone,patient.profession,patient.etat_civil,patient.adresse_domicile,dateCreation,examen_labo.id_examen,examen_labo.glycemie,examen_labo.selles,examen_labo.sang,examen_labo.urines,examen_labo.crachat,examen_labo.date_examen,examen_labo.publier FROM signes_vitaux INNER JOIN examen_labo ON examen_labo.signes_vitaux_id=signes_vitaux.id_signe INNER JOIN patient ON signes_vitaux.patient_signe_id=patient.id_patient WHERE 	publier=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         //Afficher tous les examens laboratoires publiés des patients
         public function afficherExamensLaboPatient(){
            $sql="SELECT id_signe,taille,poids,frequence,temperature,tension,patient_signe_id,patient.nom,patient.postnom,patient.prenom,patient.sexe,patient.lieu_naissance,patient.date_naissance,patient.age,patient.telephone,patient.profession,patient.etat_civil,patient.adresse_domicile,dateCreation,examen_labo.id_examen,examen_labo.glycemie,examen_labo.selles,examen_labo.sang,examen_labo.urines,examen_labo.crachat,examen_labo.date_examen,examen_labo.publier FROM signes_vitaux INNER JOIN examen_labo ON examen_labo.signes_vitaux_id=signes_vitaux.id_signe INNER JOIN patient ON signes_vitaux.patient_signe_id=patient.id_patient WHERE 	publier!=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>