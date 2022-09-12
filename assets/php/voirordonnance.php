<?php

    require_once 'connexions.php';
    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_ordonnance,description_medicament,examen_id,examen_labo.glycemie,examen_labo.selles,examen_labo.sang,examen_labo.urines,examen_labo.crachat,examen_labo.date_examen,examen_labo.publier,examen_labo.signes_vitaux_id, date_prescription,patient_ordo_id, patient.nom, patient.postnom,patient.prenom,patient.sexe,patient.etat_civil,patient.lieu_naissance,patient.date_naissance,patient.profession,patient.age FROM ordonnance_medicale INNER JOIN patient ON ordonnance_medicale.patient_ordo_id=patient.id_patient INNER JOIN examen_labo ON ordonnance_medicale.examen_id=examen_labo.id_examen WHERE id_ordonnance=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id_ordonnance'];
        $vnom=$row['nom'];
        $vage=$row['age'];
        $vsexe=$row['sexe'];
        $vP=$row['patient_ordo_id'];
        $vdescription=$row['description_medicament'];
        
    }
?>