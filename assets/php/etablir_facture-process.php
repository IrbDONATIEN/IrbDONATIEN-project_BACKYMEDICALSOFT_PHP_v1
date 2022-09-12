<?php
    
    require_once 'facture.php';

    $cfacture=new Facture();

     //Gérer la requête d'insertion facture patient avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_facture'){
        $designation=$cfacture->test_input($_POST['designation']);
        $quantite=$cfacture->test_input($_POST['quantite']);
        $prix_unitaire=$cfacture->test_input($_POST['prix_unitaire']);
        $id_patient_fac=$cfacture->test_input($_POST['id_patient_fac']);

        $cfacture->add_facture($designation,$quantite,$prix_unitaire,$id_patient_fac);
    }

    //Gérer la requête affichage des factures Patients avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherFacturesPatients'){
        $output='';
        $facture=$cfacture->afficherFacturesPatients();

        if($facture){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom patient</th>
                            <th>Prénom patient</th>
                            <th>Désignation</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($facture as $row){
                        $output .='<tr>
                                        <td>'.$row['id_facture'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['designation'].'</td>
                                        <td>'.$row['prix_unitaire'].'</td>
                                        <td>'.$row['quantite'].'</td>
                                        <td>'.$row['Total'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_facture'].'" title="Voir document facture" class="text-success infoFacturesBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_facture'].'" title="Supprimer Facture" class="text-danger deleteFacturesIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des factures patients  crééent !</h3>';
        }
    }

    //Gérer supprimer factures patients en  Ajax Request
   if(isset($_POST['del_facture_id'])){
        $id=$_POST['del_facture_id'];
        $cfacture->deleteFacture($id);
    }

?>