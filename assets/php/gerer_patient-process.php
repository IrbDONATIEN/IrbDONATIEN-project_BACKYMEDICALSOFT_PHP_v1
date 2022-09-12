<?php
    require_once 'patient.php';
   
    $cpatient=new Patient();
    
     //Gérer la requête d'insertion d'un patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_patient'){
        $nom=$cpatient->test_input($_POST['nom']);
        $postnom=$cpatient->test_input($_POST['postnom']);
        $prenom=$cpatient->test_input($_POST['prenom']);
        $sexe=$cpatient->test_input($_POST['sexe']);
        $lieu_naissance=$cpatient->test_input($_POST['lieu_naissance']);
        $date_naissance=$cpatient->test_input($_POST['date_naissance']);
        $age=$cpatient->test_input($_POST['age']);
        $telephone=$cpatient->test_input($_POST['telephone']);
        $profession=$cpatient->test_input($_POST['profession']);
        $etat_civil=$cpatient->test_input($_POST['etat_civil']);
        $adresse_domicile=$cpatient->test_input($_POST['adresse_domicile']);
        $cpatient->add_patient($nom,$postnom,$prenom,$sexe,$lieu_naissance,$date_naissance,$age,$telephone,$profession,$etat_civil,$adresse_domicile);
       
    }

    //Gérer la requête affichage des patients  avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherPatients'){
        $output='';
        $patients=$cpatient->afficherPatients();
        $path='../assets/php/';
        if($patients){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom </th>
                            <th>Postnom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Lieu Nais.</th>
                            <th>Date Nais.</th>
                            <th>Prefession</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($patients as $row){
                        $output .='<tr>
                                        <td>'.$row['id_patient'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['postnom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['sexe'].'</td>
                                        <td>'.$row['lieu_naissance'].'</td>
                                        <td>'.$row['date_naissance'].'</td>
                                        <td>'.$row['profession'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_patient'].'" title="Supprimer Patient" class="text-danger deletepatientIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des patients crééent !</h3>';
        }
    }

    //Gérer supprimer patient en  Ajax Request
   if(isset($_POST['del_patient_id'])){
        $id=$_POST['del_patient_id'];
        $cpatient->deletePatient($id);
    }

?>