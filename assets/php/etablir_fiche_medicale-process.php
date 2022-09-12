<?php
    
    require_once 'fichemedicale.php';

    $cfiche=new Fichemedicale();

     //Gérer la requête d'insertion de la fiche médicale patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_fiches'){
        $date_creation=$cfiche->test_input($_POST['date_creation']);
        $description=$cfiche->test_input($_POST['description']);
        $patient_id=$cfiche->test_input($_POST['patient_id']);

        $cfiche->add_fichemedicale($date_creation,$description,$patient_id);
    }

    //Gérer la requête affichage des fiches médicales des Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherFichesmedicales'){
        $output='';
        $fiches=$cfiche->afficherFichesmedicales();

        if($fiches){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom patient</th>
                            <th>Prénom patient</th>
                            <th>Date Création</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($fiches as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['date_creation'].'</td>
                                        <td>'.$row['description'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id'].'" title="Voir document fiche médicale Patient" class="text-success infoFichesBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id'].'" title="Supprimer fiche médicale Patient" class="text-danger deleteFichesIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des fiches médicales des patients crééent !</h3>';
        }
    }

    //Gérer supprimer des fiches médicales des patients en  Ajax Request
   if(isset($_POST['del_fiches_id'])){
        $id=$_POST['del_fiches_id'];
        $cfiche->deleteFichemedicale($id);
    }

?>