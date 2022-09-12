<?php
    
    require_once 'signes_vitaux.php';

    $csignes=new Signesvitaux();

     //Gérer la requête d'insertion signes vitaux patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_signes'){
        $taille=$csignes->test_input($_POST['taille']);
        $poids=$csignes->test_input($_POST['poids']);
        $frequence=$csignes->test_input($_POST['frequence']);
        $temperature=$csignes->test_input($_POST['temperature']);
        $tension=$csignes->test_input($_POST['tension']);
        $patient_signe_id=$csignes->test_input($_POST['patient_signe_id']);

        $csignes->add_signes_vitaux($taille,$poids,$frequence,$temperature,$tension,$patient_signe_id);
    }

    //Gérer la requête affichage des signes vitaux Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherSignesVitauxPatients'){
        $output='';
        $signes=$csignes->afficherSignesVitauxPatients();

        if($signes){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom patient</th>
                            <th>Prénom patient</th>
                            <th>Taille</th>
                            <th>Poids</th>
                            <th>Fréquence</th>
                            <th>Température</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($signes as $row){
                        $output .='<tr>
                                        <td>'.$row['id_signe'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['taille'].'</td>
                                        <td>'.$row['poids'].'</td>
                                        <td>'.$row['frequence'].'</td>
                                        <td>'.$row['temperature'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_signe'].'" title="Supprimer Signes vitaux" class="text-danger deleteSignesIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des signes vitaux des patients  crééent !</h3>';
        }
    }

    //Gérer supprimer des signes vitaux patients en  Ajax Request
   if(isset($_POST['del_signes_id'])){
        $id=$_POST['del_signes_id'];
        $csignes->deleteSigneVitaux($id);
    }

?>