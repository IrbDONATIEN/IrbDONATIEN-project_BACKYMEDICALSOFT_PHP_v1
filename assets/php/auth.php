<?php
     require_once 'config.php';
     class Auth extends Database{
        
        //Login Utilisateur
        public function loginUser($login,$password,$fonction_id){
            $sql="SELECT login_user,motdepasse_user,fonction_id FROM utilisateur WHERE login_user=:login AND motdepasse_user=:password AND fonction_id=:fonction_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['login'=>$login,'password'=>$password,'fonction_id'=>$fonction_id]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'utilisateur  connecté
        public function currentUser($login){
            $sql="SELECT utilisateur.id,matricule,nom_user,postnom_user,prenom_user,sexe_user,lieu_naissance_user,date_naissance_user, login_user,motdepasse_user,fonction_id,roles.roles FROM utilisateur INNER JOIN roles ON utilisateur.fonction_id=roles.id WHERE login_user=:login";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['login'=>$login]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Compteur de nombres des lignes dans chaque tables
        public function totalCount($tablename){
            $sql="SELECT * FROM $tablename";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre d'agences en activités
         public function totalCountsAg(){
            $sql="";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

     }
?>