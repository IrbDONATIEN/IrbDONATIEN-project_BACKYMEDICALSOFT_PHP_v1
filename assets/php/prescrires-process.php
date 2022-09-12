<?php
    
    require_once 'ordonnance_medicale.php';

    $cordonnance=new Ordonnancemedicale();

     //Gérer la requête d'insertion d'ordonnance médicale patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_ordonnances'){
        $description_medicament=$cordonnance->test_input($_POST['description_medicament']);
        $examen_id=$cordonnance->test_input($_POST['examen_id']);
        $patient_ordo_id=$cordonnance->test_input($_POST['patient_ordo_id']);

        $cordonnance->add_ordonnance_medicale($description_medicament,$examen_id,$patient_ordo_id);
    }

    //Gérer la requête affichage des ordonnances médicales des Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherOrdonnancesmedicales'){
        $output='';
        $ordonnances=$cordonnance->afficherOrdonnancesmedicales();

        if($ordonnances){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom patient</th>
                            <th>Prénom patient</th>
                            <th>Taille</th>
                            <th>Poids</th>
                            <th>Glycémie</th>
                            <th>Selles</th>
                            <th>Ordonnance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($ordonnances as $row){
                        $output .='<tr>
                                        <td>'.$row['id_ordonnance'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['taille'].'</td>
                                        <td>'.$row['poids'].'</td>
                                        <td>'.$row['glycemie'].'</td>
                                        <td>'.$row['selles'].'</td>
                                        <td>'.$row['description_medicament'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_ordonnance'].'" title="Voir document ordonnance Patient" class="text-success infoOrdonnancesBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_ordonnance'].'" title="Supprimer Ordonnance Patient" class="text-danger deleteOrdonnancesIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore d\'Ordonnances médicales des patients crééent !</h3>';
        }
    }

    //Gérer supprimer des ordonnances médicales des patients en  Ajax Request
   if(isset($_POST['del_ordonnances_id'])){
        $id=$_POST['del_ordonnances_id'];
        $cordonnance->deleteOrdonnancemedicale($id);
    }

?>