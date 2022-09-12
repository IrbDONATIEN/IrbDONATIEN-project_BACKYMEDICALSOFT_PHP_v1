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
    <div class="card border-dark mt-2">
        <h5 class="card-header bg-dark d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fas fa-file"></i>&nbsp;Tous les signes vitaux des Patients</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addSignesModal"><i class="fas fa-file"></i>&nbsp;Ajouter Signes Vitaux Patient</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherSignes">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>
<!--Début d'Ajout des signes vitaux patients-->
<div class="modal fade" id="addSignesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-file"></i>&nbsp;Ajouter Signes Vitaux Patient</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-signe-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="number" name="taille" id="taille" class="form-control form-control-lg" placeholder="Entrer taille patient" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="number" name="poids" id="poids" class="form-control form-control-lg" placeholder="Entrer poids patient" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="frequence" id="frequence" class="form-control form-control-lg" placeholder="Entrer fréquence Patient" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="temperature" id="temperature" class="form-control form-control-lg" placeholder="Entrer temperature patient" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="tension" id="tension" class="form-control form-control-lg" placeholder="Entrer tension patient" required>
                    </div>
                    <div class="form-group">
                        <label for="patient_signe_id">Sélectionner Patient:</label>
                        <select name="patient_signe_id" id="patient_signe_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_patient'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addSignes" class="btn btn-dark btn-block btn-lg" id="addSignesBtn" value="Ajouter Signes Vitaux Patient" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout signes vitaux patients-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){


        //Delete Signes vitaux patient 
        $("body").on("click", ".deleteSignesIcon", function(e){
            e.preventDefault();

            del_signes_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-les!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/signes_vitaux-process.php',
                            method:'post',
                            data:{del_signes_id:del_signes_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Signes Vitaux Patient !',
                                    'Signes Vitaux Patient supprimés avec succès.',
                                    'success'
                                )
                                afficherSignesVitauxPatients();
                            }
                        });
                        
                    }
                })

        });
    
        //Ajouter signes vitaux  patient en Ajax Request
        $("#addSignesBtn").click(function(e){
            if($("#add-signe-form")[0].checkValidity()){
                e.preventDefault();
                $("#addSignesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/signes_vitaux-process.php',
                    method:'post',
                    data:$("#add-signe-form").serialize()+'&action=add_signes',
                    success:function(response){
                            $("#addSignesBtn").val('Ajouter Signes Vitaux Patient');
                            $("#add-signe-form")[0].reset();
                            $("#addSignesModal").modal('hide');
                            Swal.fire({
                                title:'Signes vitaux patient ajouté avec succès !',
                                type:'success'
                            });
                            afficherSignesVitauxPatients();
                    }
                });
            }
        });

        //Fetch All signes vitaux des patients Ajax Request
        afficherSignesVitauxPatients();

        function afficherSignesVitauxPatients(){
            $.ajax({
                url:'../assets/php/signes_vitaux-process.php',
                method: 'post',
                data:{action: 'afficherSignesVitauxPatients'},
                success:function(response){
                    $("#afficherSignes").html(response);
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