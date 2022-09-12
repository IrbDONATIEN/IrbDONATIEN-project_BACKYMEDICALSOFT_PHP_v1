<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/connexion.php';
?>
<div class="container mt-2">
    <div class="alert alert-dark alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-15">
            <strong>Bienvenu(e) dans le système médicale BACKYMEDICALSOFT Rôles:<?=$croles;?>&nbsp;Matricule:&nbsp;<?=$cmatricule;?></strong>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card rounded-0 mt-3 border-success">
                <div class="card-header border-success">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#LExamens" class="nav-link active font-weight-bold" data-toggle="tab">Liste d'Examens Labo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#Ordonnances" class="nav-link font-weight-bold" data-toggle="tab">Prescrire Médicament</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="LExamens">
                            <div class="card-deck">
                                <div class="table-responsive" id="afficherExamens">
                                    <p class="text-center lead mt-5">Veuillez patienter...</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container" id="Ordonnances">
                            <div class="card border-dark mt-2">
                                <h5 class="card-header bg-dark d-flex justify-content-between">
                                    <span class="text-light lead align-self-center"><i class="fas fa-user"></i>&nbsp;Toutes les Ordonnances des Patients</span>
                                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addOrdonnancesModal"><i class="fas fa-user"></i>&nbsp;Ajouter Ordonnance Patient</a>
                                </h5>
                                <div class="card-body">
                                    <div class="table-responsive" id="afficherOrdonnances">
                                        <p class="text-center lead mt-5">Veuillez patienter...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Début d'Ajout d'ordonnances Labo patients-->
<div class="modal fade" id="addOrdonnancesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-user"></i>&nbsp;Ajouter Ordonnance Patient</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-ordonnance-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <textarea name="description_medicament" id="description_medicament" class="form-control form-control-lg" cols="15" rows="7" placeholder="Entrer description médicale" required autofocus></textarea>
                    </div>
                    <div class="form-group">
                        <label for="patient_ordo_id">Sélectionner Patient:</label>
                        <select name="patient_ordo_id" id="patient_ordo_id" class="form-control form-control-lg" required>
                               <?php $req=$db->query("SELECT * FROM patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_patient'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="examen_id">Sélectionner Examen Labo Patient:</label>
                        <select name="examen_id" id="examen_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT id_signe,taille,poids,frequence,temperature,tension,patient_signe_id,patient.nom, patient.postnom, patient.prenom, dateCreation, examen_labo.id_examen, examen_labo.glycemie, examen_labo.selles FROM signes_vitaux INNER JOIN examen_labo ON examen_labo.signes_vitaux_id=signes_vitaux.id_signe INNER JOIN patient ON signes_vitaux.patient_signe_id=patient.id_patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_examen'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?>|&nbsp;<?php echo $tab['glycemie'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addOrdonnances" class="btn btn-dark btn-block btn-lg" id="addOrdonnancesBtn" value="Ajouter Ordonnance Patient" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout d'ordonnances patients-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Afficher voir  ordonnance patient  en Ajax Request
        $("body").on("click", ".infoOrdonnancesBtn", function(e){
                e.preventDefault();
                detail_ordonnance_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/ordonnance_medicale-process.php',
                    type:'post',
                    data:{detail_ordonnance_id:detail_ordonnance_id},
                    success:function(response){
                        window.location ='document_ordonnance.php?id='+detail_ordonnance_id;
                    }
                });
        });

        //Ajouter ordonnance patient en Ajax Request
        $("#addOrdonnancesBtn").click(function(e){
            if($("#add-ordonnance-form")[0].checkValidity()){
                e.preventDefault();
                $("#addOrdonnancesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/ordonnance_medicale-process.php',
                    method:'post',
                    data:$("#add-ordonnance-form").serialize()+'&action=add_ordonnances',
                    success:function(response){
                        $("#addOrdonnancesBtn").val('Ajouter Ordonnance Patient');
                        $("#add-ordonnance-form")[0].reset();
                        $("#addOrdonnancesModal").modal('hide');
                        Swal.fire({
                            title:'Ordonnance  ajoutée avec succès !',
                            type:'success'
                        });
                        afficherOrdonnancesmedicales();
                    }
                });
            }
        });
        
        //Delete Ordonnance  patient 
        $("body").on("click", ".deleteOrdonnancesIcon", function(e){
            e.preventDefault();

            del_ordonnances_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-la!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/ordonnance_medicale-process.php',
                            method:'post',
                            data:{del_ordonnances_id:del_ordonnances_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Ordonnance Patient !',
                                    'Ordonnance Patient supprimée avec succès.',
                                    'success'
                                )
                                afficherOrdonnancesmedicales();
                            }
                        });
                        
                    }
                })

        });
    
         //Fetch All Ordonnances  des patients Ajax Request
         afficherOrdonnancesmedicales();

        function afficherOrdonnancesmedicales(){
            $.ajax({
                url:'../assets/php/ordonnance_medicale-process.php',
                method: 'post',
                data:{action: 'afficherOrdonnancesmedicales'},
                success:function(response){
                    $("#afficherOrdonnances").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

        //Fetch All Examens Labo des patients Ajax Request
        afficherExamensLaboPatient();

        function afficherExamensLaboPatient(){
            $.ajax({
                url:'../assets/php/ordonnance_medicale-process.php',
                method: 'post',
                data:{action: 'afficherExamensLaboPatient'},
                success:function(response){
                    $("#afficherExamens").html(response);
                    $("tables").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }
    });
</script>
</body>
</html>