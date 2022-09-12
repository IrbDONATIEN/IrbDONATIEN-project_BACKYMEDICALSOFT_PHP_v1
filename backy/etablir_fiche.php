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
            <span class="text-light lead align-self-center"><i class="fas fa-pen"></i>&nbsp;Toutes les Fiches des Patients</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addFichesModal"><i class="fas fa-pen"></i>&nbsp;Ajouter Fiche Patient</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherFiches">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>
<!--Début d'Ajout fiches médicales patients-->
<div class="modal fade" id="addFichesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-business-time"></i>&nbsp;Ajouter Facture</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-fiche-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <textarea name="description" id="description" cols="20" rows="10" class="form-control form-control-lg" placeholder="Entrer designation facture" required autofocus></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_creation">Sélectionner Date Fiche Médicale:</label>
                        <input type="date" name="date_creation" id="date_creation" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                    <label for="patient_id">Sélectionner Patient:</label>
                        <select name="patient_id" id="patient_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_patient'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addFiches" class="btn btn-dark btn-block btn-lg" id="addFichesBtn" value="Ajouter Fiche Médicale" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout fiche médicales des patients-->

<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        
        //Afficher voir  fiche médicale  en Ajax Request
        $("body").on("click", ".infoFichesBtn", function(e){
                e.preventDefault();
                detail_fiche_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/etablir_fiche_medicale-process.php',
                    type:'post',
                    data:{detail_fiche_id:detail_fiche_id},
                    success:function(response){
                        window.location ='document_fiche.php?id='+detail_fiche_id;
                    }
                });
        });


        //Delete Fiche Médicale patient 
        $("body").on("click", ".deleteFichesIcon", function(e){
            e.preventDefault();

            del_fiches_id=$(this).attr('id');

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
                            url:'../assets/php/etablir_fiche_medicale-process.php',
                            method:'post',
                            data:{del_fiches_id:del_fiches_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Fiche Médicale Patient !',
                                    'Fiche Médicale Patient supprimée avec succès.',
                                    'success'
                                )
                                afficherFichesmedicales();
                            }
                        });
                        
                    }
                })

        });

        //Ajouter fiche médicale patient en Ajax Request
        $("#addFichesBtn").click(function(e){
            if($("#add-fiche-form")[0].checkValidity()){
                e.preventDefault();
                $("#addFichesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/etablir_fiche_medicale-process.php',
                    method:'post',
                    data:$("#add-fiche-form").serialize()+'&action=add_fiches',
                    success:function(response){
                        $("#addFichesBtn").val('Ajouter Fiche Médicale');
                        $("#add-fiche-form")[0].reset();
                        $("#addFichesModal").modal('hide');
                        Swal.fire({
                            title:'Fiche Médicale ajoutée avec succès !',
                            type:'success'
                        });
                        afficherFichesmedicales();
                    }
                });
            }
        });

        //Fetch All fiches des patients Ajax Request
        afficherFichesmedicales();

        function afficherFichesmedicales(){
            $.ajax({
                url:'../assets/php/etablir_fiche_medicale-process.php',
                method: 'post',
                data:{action: 'afficherFichesmedicales'},
                success:function(response){
                    $("#afficherFiches").html(response);
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