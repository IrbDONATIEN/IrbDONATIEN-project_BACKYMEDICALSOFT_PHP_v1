<?php
    
    require_once 'frais.php';

    $cfrais=new Frais();

     //Gérer la requête d'insertion frais patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_frais'){
        $type_frais=$cfrais->test_input($_POST['type_frais']);
        $prix_unitaire=$cfrais->test_input($_POST['prix_unitaire']);
        $qte=$cfrais->test_input($_POST['qte']);
        $patient_frais_id=$cfrais->test_input($_POST['patient_frais_id']);
        $cfrais->add_frais($type_frais,$prix_unitaire,$qte,$patient_frais_id);
    }

    //Gérer la requête affichage des frais Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherFraisPatients'){
        $output='';
        $frais=$cfrais->afficherFraisPatients();

        if($frais){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom patient</th>
                            <th>Prénom patient</th>
                            <th>Type Frais</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Total Frais</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($frais as $row){
                        $output .='<tr>
                                        <td>'.$row['id_frais'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['type_frais'].'</td>
                                        <td>'.$row['prix_unitaire'].'</td>
                                        <td>'.$row['qte'].'</td>
                                        <td>'.$row['Total'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_frais'].'" title="Voir document frais" class="text-success infoFraisBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_frais'].'" title="Supprimer Frais" class="text-danger deleteFraisIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des frais patients crééent !</h3>';
        }
    }

    //Gérer supprimer frais patients en  Ajax Request
   if(isset($_POST['del_frais_id'])){
    $id=$_POST['del_frais_id'];
    $cfrais->deleteFrais($id);
   }

?>