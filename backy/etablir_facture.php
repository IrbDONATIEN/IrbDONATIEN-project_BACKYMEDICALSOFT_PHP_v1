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
            <span class="text-light lead align-self-center"><i class="fas fa-business-time"></i>&nbsp;Tous les Factures Patients</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addFacturesModal"><i class="fas fa-business-time"></i>&nbsp;Ajouter Facture Patient</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherFactures">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>
<!--Début d'Ajout factures patients-->
<div class="modal fade" id="addFacturesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-business-time"></i>&nbsp;Ajouter Facture</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-facture-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="designation" id="designation" class="form-control form-control-lg" placeholder="Entrer designation facture" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="number" name="prix_unitaire" id="prix_unitaire" class="form-control form-control-lg" placeholder="Entrer prix unitaire" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="quantite" id="quantite" class="form-control form-control-lg" placeholder="Entrer qte" required>
                    </div>
                    <div class="form-group">
                        <label for="id_patient_fac">Sélectionner Patient:</label>
                        <select name="id_patient_fac" id="id_patient_fac" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_patient'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addFactures" class="btn btn-dark btn-block btn-lg" id="addFacturesBtn" value="Ajouter Facture" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout factures patients-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
        
        //Afficher voir  facture  en Ajax Request
        $("body").on("click", ".infoFacturesBtn", function(e){
                e.preventDefault();
                detail_facture_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/etablir_facture-process.php',
                    type:'post',
                    data:{detail_facture_id:detail_facture_id},
                    success:function(response){
                        window.location ='document_facture.php?id='+detail_facture_id;
                    }
                });
        });

        //Ajouter frais patient en Ajax Request
        $("#addFacturesBtn").click(function(e){
            if($("#add-facture-form")[0].checkValidity()){
                e.preventDefault();
                $("#addFacturesBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/etablir_facture-process.php',
                    method:'post',
                    data:$("#add-facture-form").serialize()+'&action=add_facture',
                    success:function(response){
                            $("#addFacturesBtn").val('Ajouter Facture');
                            $("#add-facture-form")[0].reset();
                            $("#addFacturesModal").modal('hide');
                            Swal.fire({
                                title:'Frais ajouté avec succès !',
                                type:'success'
                            });
                            afficherFacturesPatients();
                    }
                });
            }
        });

        //Delete Facture patient 
        $("body").on("click", ".deleteFacturesIcon", function(e){
            e.preventDefault();

            del_facture_id=$(this).attr('id');

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
                            url:'../assets/php/etablir_facture-process.php',
                            method:'post',
                            data:{del_facture_id:del_facture_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Facture Patient !',
                                    'Facture Patient supprimée avec succès.',
                                    'success'
                                )
                                afficherFacturesPatients();
                            }
                        });
                        
                    }
                })

        });
    
        //Fetch All factures des patients Ajax Request
        afficherFacturesPatients();

        function afficherFacturesPatients(){
            $.ajax({
                url:'../assets/php/etablir_facture-process.php',
                method: 'post',
                data:{action: 'afficherFacturesPatients'},
                success:function(response){
                    $("#afficherFactures").html(response);
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