<?php
    
    require_once 'ordonnance_medicale.php';

    $cordonnances=new Ordonnancemedicale();

    require_once 'examen_labo.php';

    $cexamen=new Examenlabo();

     //Gérer la requête d'insertion d'ordonnances  patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_ordonnances'){
        $description_medicament=$cordonnances->test_input($_POST['description_medicament']);
        $examen_id=$cordonnances->test_input($_POST['examen_id']);
        $patient_ordo_id=$cordonnances->test_input($_POST['patient_ordo_id']);

        $cordonnances->add_ordonnance_medicale($description_medicament,$examen_id,$patient_ordo_id);
    }

    //Gérer la requête affichage d'ordonnances des  Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherOrdonnancesmedicales'){
        $output='';
        $ordonnances=$cordonnances->afficherOrdonnancesmedicales();

        if($ordonnances){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom patient</th>
                            <th>Prénom patient</th>
                            <th>Description</th>
                            <th>Glycemie</th>
                            <th>Selles</th>
                            <th>Sang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($ordonnances as $row){
                        $output .='<tr>
                                        <td>'.$row['id_ordonnance'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['description_medicament'].'</td>
                                        <td>'.$row['glycemie'].'</td>
                                        <td>'.$row['selles'].'</td>
                                        <td>'.$row['sang'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_ordonnance'].'" title="Voir document Ordonnance" class="text-success infoOrdonnancesBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;
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
            echo '<h3 class="text-center text-secondary">:( Pas encore d\'ordonnances des patients  crééent !</h3>';
        }
    }

   //Gérer supprimer d'ordonnances patients en  Ajax Request
   if(isset($_POST['del_ordonnances_id'])){
        $id=$_POST['del_ordonnances_id'];
        $cordonnances->deleteOrdonnancemedicale($id);
    }



    //Gérer la requête affichage des examens des Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherExamensLaboPatient'){
        $output='';
        $examens=$cexamen->afficherExamensLaboPatient();

        if($examens){
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
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($examens as $row){
                        $output .='<tr>
                                        <td>'.$row['id_examen'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['taille'].'</td>
                                        <td>'.$row['poids'].'</td>
                                        <td>'.$row['glycemie'].'</td>
                                        <td>'.$row['selles'].'</td>
                                       
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des examens laboratoires des patients publiés crééent !</h3>';
        }
    }

?>