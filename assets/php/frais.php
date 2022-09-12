<?php
    require_once 'config.php';
    class Frais extends Database{

        //Enregistrer frais de patient 
        public function add_frais($type_frais,$prix_unitaire,$qte,$patient_frais_id){
            $sql="INSERT INTO frais(type_frais,prix_unitaire,qte,patient_frais_id) VALUES (:type_frais,:prix_unitaire,:qte,:patient_frais_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['type_frais'=>$type_frais,'prix_unitaire'=>$prix_unitaire,'qte'=>$qte,'patient_frais_id'=>$patient_frais_id]);
            return true;
        }

        //Affichage avant l'édition de frais de  patient dans la base de données
        public function editerFrais($id){
            $sql="SELECT * FROM frais WHERE id_frais=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de frais de patient
        public function update_frais($id,$type_frais,$prix_unitaire,$qte,$patient_frais_id){
            $sql="UPDATE frais SET type_frais=:type_frais,prix_unitaire=:prix_unitaire,qte=:qte,patient_frais_id=:patient_frais_id WHERE id_frais=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['type_frais'=>$type_frais,'prix_unitaire'=>$prix_unitaire,'qte'=>$qte,'patient_frais_id'=>$patient_frais_id,'id'=>$id]);
            return true;
        }

        //Delete frais de patient
        public function deleteFrais($id){
            $sql="DELETE FROM frais WHERE id_frais=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les frais des patients
        public function afficherFraisPatients(){
            $sql="SELECT id_frais,type_frais,prix_unitaire,qte,(prix_unitaire*qte) as Total, date_created,patient_frais_id,patient.nom,patient.postnom,patient.prenom,patient.age FROM frais INNER JOIN patient ON frais.patient_frais_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


    }
?>