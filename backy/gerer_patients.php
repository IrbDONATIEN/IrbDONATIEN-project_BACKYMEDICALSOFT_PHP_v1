<?php
    require_once '../assets/php/header.php';
?>
<div class="container mt-2">
    <div class="alert alert-dark alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-15">
            <strong>Bienvenu(e) dans le système médicale BACKYMEDICALSOFT Rôles:<?=$croles;?>&nbsp;Matricule:&nbsp;<?=$cmatricule;?></strong>
        </div>
    </div>
    <hr>
    <div class="card border-dark mt-2">
        <h5 class="card-header bg-dark d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fas fa-folder"></i>&nbsp;Tous les Patients</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addPatientsModal"><i class="fas fa-folder"></i>&nbsp;Ajouter Patient</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherPatients">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>
<!--Début d'Ajout patients-->
<div class="modal fade" id="addPatientsModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-folder"></i>&nbsp;Ajouter Patient</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-patient-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="nom" id="nom" class="form-control form-control-lg" placeholder="Entrer nom patient" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="postnom" id="postnom" class="form-control form-control-lg" placeholder="Entrer postnom patient" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom" id="prenom" class="form-control form-control-lg" placeholder="Entrer prénom patient" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Séléctionner Sexe Patient:</label>
                        <select name="sexe" id="sexe" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner sexe du patient</option>
                            <option value="Masculin" required>Masculin</option>
                            <option value="Feminin" required>Féminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lieu_naissance" id="lieu_naissance" class="form-control form-control-lg" placeholder="Entrer lieu de naissance du patient" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe_agent">Séléctionner date naissance patient :</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="age" id="age" class="form-control form-control-lg" placeholder="Entrer âge patient" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telephone" id="telephone" class="form-control form-control-lg" placeholder="Entrer numéro téléphone du patient" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="profession" id="profession" class="form-control form-control-lg" placeholder="Entrer profession du patient" required>
                    </div>
                    <div class="form-group">
                        <label for="etat_civil">Séléctionner Etat Civil du patient:</label>
                        <select name="etat_civil" id="etat_civil" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner état civil du patient</option>
                            <option value="Celibataire" required>Célibataire</option>
                            <option value="Marie(e)" required>Marié(e)</option>
                            <option value="Divorce(e)" required>Divorcé(e)</option>
                            <option value="Veuf(ve)" required>Veuf(ve)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="adresse_domicile" id="adresse_domicile" cols="5" rows="5" class="form-control form-control-lg" placeholder="Entrer adresse du domicile  du patient" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addPatients" class="btn btn-dark btn-block btn-lg" id="addPatientsBtn" value="Ajouter Patient" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout patients-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){


        //Delete patient 
        $("body").on("click", ".deletepatientIcon", function(e){
            e.preventDefault();

            del_patient_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/gerer_patient-process.php',
                            method:'post',
                            data:{del_patient_id:del_patient_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Patient !',
                                    'Patient supprimée avec succès.',
                                    'success'
                                )
                                afficherPatients();
                            }
                        });
                        
                    }
                })

        });

            //Ajouter patient en Ajax Request
            $("#addPatientsBtn").click(function(e){
            if($("#add-patient-form")[0].checkValidity()){
                e.preventDefault();
                $("#addPatientsBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/gerer_patient-process.php',
                    method:'post',
                    data:$("#add-patient-form").serialize()+'&action=add_patient',
                    success:function(response){
                            $("#addPatientsBtn").val('Ajouter Patient');
                            $("#add-patient-form")[0].reset();
                            $("#addPatientsModal").modal('hide');
                            Swal.fire({
                                title:'Patient ajouté avec succès !',
                                type:'success'
                            });
                            afficherPatients();
                    }
                });
            }
        });

        //Fetch All patients Ajax Request
        afficherPatients();

        function afficherPatients(){
            $.ajax({
                url:'../assets/php/gerer_patient-process.php',
                method: 'post',
                data:{action: 'afficherPatients'},
                success:function(response){
                    $("#afficherPatients").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }
    });
</script>
</body>
</html>