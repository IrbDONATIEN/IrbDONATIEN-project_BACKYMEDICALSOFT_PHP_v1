<?php

    require_once 'connexions.php';
    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_frais,type_frais,prix_unitaire,qte,(prix_unitaire*qte) as Total, date_created,patient_frais_id,patient.nom,patient.postnom,patient.prenom,patient.age FROM frais INNER JOIN patient ON frais.patient_frais_id WHERE frais.id_frais=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id_frais'];
        $vpatient=$row['patient_frais_id'];
        $vtype=$row['type_frais'];
        $vqte=$row['qte'];
        $vpu=$row['prix_unitaire'];
        $vTotal=$row['Total'];
        $vEntreprise=$row['nom'];
        
    }
?>