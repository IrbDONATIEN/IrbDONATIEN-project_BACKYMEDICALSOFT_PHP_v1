<?php

    require_once 'connexions.php';
    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id,date_creation,description,patient_id,patient.nom,patient.postnom,patient.prenom,patient.sexe,patient.lieu_naissance,patient.date_naissance,patient.age,patient.telephone,patient.profession,patient.etat_civil,patient.adresse_domicile,patient.create_date FROM fiche_medicale INNER JOIN patient ON fiche_medicale.patient_id=patient.id_patient WHERE id=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id'];
        $vdossier=$row['patient_id'];
        $vnom=$row['nom'];
        $vdate_fiche=$row['date_creation'];
        $vdescription=$row['description'];
        $vpostnom=$row['postnom'];
        $vprenom=$row['prenom'];
        $vsexe=$row['sexe'];
        $vdate=$row['date_naissance']; 
        $vlieu=$row['lieu_naissance'];
        $vtel=$row['telephone'];
        $vadresse=$row['adresse_domicile'];
        $vprofession=$row['profession'];
        $vdate_entree=$row['create_date'];

        
    }
?>