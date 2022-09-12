<?php
    require_once 'config.php';
    class Facture extends Database{

        //Enregistrer facture de patient 
        public function add_facture($designation,$quantite,$prix_unitaire,$id_patient_fac){
            $sql="INSERT INTO facture(designation,quantite,prix_unitaire,id_patient_fac) VALUES (:designation,:quantite,:prix_unitaire,:id_patient_fac)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['designation'=>$designation,'quantite'=>$quantite,'prix_unitaire'=>$prix_unitaire,'id_patient_fac'=>$id_patient_fac]);
            return true;
        }

        //Affichage avant l'édition de facture patient existante dans la base de données
        public function editerFacture($id){
            $sql="SELECT * FROM facture WHERE id_facture=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de la facture patient
        public function update_facture($id,$designation,$quantite,$prix_unitaire,$id_patient_fac){
            $sql="UPDATE facture SET designation=:designation,quantite=:quantite,prix_unitaire=:prix_unitaire,id_patient_fac=:id_patient_fac WHERE id_facture=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['designation'=>$designation,'quantite'=>$quantite,'prix_unitaire'=>$prix_unitaire,'id_patient_fac'=>$id_patient_fac,'id'=>$id]);
            return true;
        }

        //Delete facture de patient
        public function deleteFacture($id){
            $sql="DELETE FROM facture WHERE id_facture=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les factures des patients
        public function afficherFacturesPatients(){
            $sql="SELECT id_facture,designation,quantite,prix_unitaire,(quantite*prix_unitaire) as Total,dateJour,id_patient_fac,patient.nom,patient.postnom,patient.prenom,patient.sexe, patient.age FROM facture INNER JOIN patient ON facture.id_patient_fac=patient.id_patient";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


    }
?>