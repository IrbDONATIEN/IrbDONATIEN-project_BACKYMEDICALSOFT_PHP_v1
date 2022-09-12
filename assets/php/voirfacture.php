<?php

    require_once 'connexions.php';
    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_facture,designation,quantite,prix_unitaire,(quantite*prix_unitaire) as Total,dateJour,id_patient_fac,patient.nom,patient.postnom,patient.prenom,patient.sexe, patient.age FROM facture INNER JOIN patient ON facture.id_patient_fac=patient.id_patient WHERE facture.id_facture=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id_facture'];
        $vtype=$row['designation'];
        $vqte=$row['quantite'];
        $vpu=$row['prix_unitaire'];
        $vTotal=$row['Total'];
        $vEntreprise=$row['nom'];
        
    }
?>