<?php
    
    require_once 'examen_labo.php';

    $cexamen=new Examenlabo();

     //Gérer la requête d'insertion examens laboratoire patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_examens'){
        $glycemie=$cexamen->test_input($_POST['glycemie']);
        $selles=$cexamen->test_input($_POST['selles']);
        $sang=$cexamen->test_input($_POST['sang']);
        $urines=$cexamen->test_input($_POST['urines']);
        $crachat=$cexamen->test_input($_POST['crachat']);
        $signes_vitaux_id=$cexamen->test_input($_POST['signes_vitaux_id']);

        $cexamen->add_examen_labo($glycemie,$selles,$sang,$urines,$crachat,$signes_vitaux_id);
    }

    //Gérer la requête affichage des examens des Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherExamensLaboPatients'){
        $output='';
        $examens=$cexamen->afficherExamensLaboPatients();

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
                            <th>Action</th>
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
                                        <td>
                                            <a href="#" id="'.$row['id_examen'].'" title="Publier examen Labo" class="text-dark publierExamensIcon"><i class="fas fa-trash fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['id_examen'].'" title="Supprimer examen Labo" class="text-danger deleteExamensIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des examens laboratoires des patients crééent !</h3>';
        }
    }

    //Gérer supprimer des examens des patients en  Ajax Request
   if(isset($_POST['del_examens_id'])){
        $id=$_POST['del_examens_id'];
        $cexamen->deleteExamenLabo($id);
   }

    //Gérer valider ou publier des examens des patients en  Ajax Request
   if(isset($_POST['del_valider_id'])){
        $id=$_POST['del_valider_id'];
        $cexamen->publierExamenLabo($id);
   }

?>